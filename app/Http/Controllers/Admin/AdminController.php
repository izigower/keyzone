<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\CategorieProduit;
use App\Models\Plateforme;
use App\Models\CleJeu;
use App\Models\CodePromo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ========== DASHBOARD ==========
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'produits' => Produit::count(),
            'commandes' => Commande::count(),
            'revenus' => Commande::where('statut', 'payee')->sum('montant_total'),
            'commandes_recentes' => Commande::with('user')->latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // ========== USERS ==========
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail() && $request->role === 'admin') {
            return back()->with('error', 'Impossible de promouvoir un utilisateur non vérifié en admin.');
        }

        $user->update(['role' => $request->role]);
        return back()->with('success', "Rôle de {$user->username} mis à jour.");
    }

    public function toggleUserActive($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Compte de {$user->username} {$status}.");
    }

    // ========== CATEGORIES ==========
    public function categories()
    {
        $categories = CategorieProduit::withCount('produits')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:categorie_produits,nom',
            'description' => 'nullable|string',
        ]);

        CategorieProduit::create($validated);
        return back()->with('success', 'Catégorie créée.');
    }

    public function updateCategory(Request $request, $id)
    {
        $categorie = CategorieProduit::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|unique:categorie_produits,nom,' . $id,
            'description' => 'nullable|string',
        ]);
        $categorie->update(array_merge($validated, ['slug' => Str::slug($validated['nom'])]));
        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroyCategory($id)
    {
        $categorie = CategorieProduit::findOrFail($id);
        if ($categorie->is_default) {
            return back()->with('error', 'Impossible de supprimer la catégorie par défaut.');
        }
        // Move products to default category
        $default = CategorieProduit::where('is_default', true)->first();
        if ($default) {
            Produit::where('categorie_id', $id)->update(['categorie_id' => $default->id]);
        }
        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée. Les produits ont été déplacés dans "Non catégorisé".');
    }

    // ========== PRODUCTS ==========
    public function produits()
    {
        $produits = Produit::with(['categorie', 'plateforme'])->withCount('clesDisponibles')->orderBy('created_at', 'desc')->paginate(20);
        $categories = CategorieProduit::all();
        $plateformes = Plateforme::all();
        return view('admin.produits', compact('produits', 'categories', 'plateformes'));
    }

    public function storeProduit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_original' => 'nullable|numeric|min:0',
            'image' => 'nullable|string|max:500',
            'categorie_id' => 'required|exists:categorie_produits,id',
            'plateforme_id' => 'required|exists:plateformes,id',
            'badge' => 'nullable|string|max:50',
            'age_rating' => 'nullable|integer|min:0|max:18',
        ]);

        $produit = Produit::create($validated);
        return back()->with('success', "Produit \"{$produit->nom}\" créé.");
    }

    public function editProduit($id)
    {
        $produit = Produit::with('cles')->findOrFail($id);
        $categories = CategorieProduit::all();
        $plateformes = Plateforme::all();
        return view('admin.edit-produit', compact('produit', 'categories', 'plateformes'));
    }

    public function updateProduit(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_original' => 'nullable|numeric|min:0',
            'image' => 'nullable|string|max:500',
            'categorie_id' => 'required|exists:categorie_produits,id',
            'plateforme_id' => 'required|exists:plateformes,id',
            'badge' => 'nullable|string|max:50',
            'age_rating' => 'nullable|integer|min:0|max:18',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['nom']);
        $produit->update($validated);
        return back()->with('success', 'Produit mis à jour.');
    }

    public function destroyProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('admin.produits')->with('success', 'Produit supprimé.');
    }

    // ========== GAME KEYS ==========
    public function addKeys(Request $request, $produitId)
    {
        $request->validate([
            'cles' => 'required|string',
        ]);

        $produit = Produit::findOrFail($produitId);
        $cles = array_filter(array_map('trim', explode("\n", $request->cles)));
        $count = 0;

        foreach ($cles as $cle) {
            if (!empty($cle)) {
                CleJeu::create([
                    'produit_id' => $produit->id,
                    'cle' => $cle,
                    'statut' => 'disponible',
                ]);
                $count++;
            }
        }

        // Update stock count
        $produit->update(['stock' => $produit->clesDisponibles()->count()]);

        return back()->with('success', "{$count} clé(s) ajoutée(s) pour {$produit->nom}.");
    }

    // ========== ORDERS ==========
    public function commandes()
    {
        $commandes = Commande::with('user', 'paiement')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.commandes', compact('commandes'));
    }

    // ========== PROMO CODES ==========
    public function promos()
    {
        $promos = CodePromo::orderBy('created_at', 'desc')->get();
        return view('admin.promos', compact('promos'));
    }

    public function storePromo(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:code_promos,code',
            'type' => 'required|in:pourcentage,fixe',
            'valeur' => 'required|numeric|min:0',
            'utilisations_max' => 'nullable|integer|min:1',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date|after:date_debut',
        ]);

        $validated['code'] = strtoupper($validated['code']);
        CodePromo::create($validated);
        return back()->with('success', 'Code promo créé.');
    }

    public function destroyPromo($id)
    {
        CodePromo::findOrFail($id)->delete();
        return back()->with('success', 'Code promo supprimé.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\LignePanier;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    public function index()
    {
        $panier = $this->getOrCreatePanier();
        $lignes = $panier->lignes()->with('produit')->get();
        $total = $panier->total;

        return view('panier.index', compact('lignes', 'total'));
    }

    public function ajouter(Request $request)
    {
        $validated = $request->validate([
            'id_produit' => 'required|exists:produit,id_produit',
            'quantite' => 'integer|min:1',
        ]);

        $panier = $this->getOrCreatePanier();
        $quantite = $validated['quantite'] ?? 1;

        $ligne = LignePanier::where('id_panier', $panier->id_panier)
            ->where('id_produit', $validated['id_produit'])
            ->first();

        if ($ligne) {
            $ligne->quantite += $quantite;
            $ligne->save();
        } else {
            LignePanier::create([
                'id_panier' => $panier->id_panier,
                'id_produit' => $validated['id_produit'],
                'quantite' => $quantite,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'count' => $this->getPanierCount()
        ]);
    }

    public function supprimer($id)
    {
        $ligne = LignePanier::findOrFail($id);
        $ligne->delete();

        return redirect()->back()->with('success', 'Article supprimé du panier');
    }

    public function mettreAJour(Request $request, $id)
    {
        $validated = $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $ligne = LignePanier::findOrFail($id);
        $ligne->quantite = $validated['quantite'];
        $ligne->save();

        return redirect()->back()->with('success', 'Panier mis à jour');
    }

    public function vider()
    {
        $panier = $this->getOrCreatePanier();
        $panier->lignes()->delete();

        return redirect()->back()->with('success', 'Panier vidé');
    }

    private function getOrCreatePanier()
    {
        $panier = Panier::where('id_utilisateur', Auth::id())->first();

        if (!$panier) {
            $panier = Panier::create([
                'id_utilisateur' => Auth::id(),
                'date_creation' => now(),
                'date_modification' => now(),
            ]);
        }

        return $panier;
    }

    private function getPanierCount()
    {
        $panier = Panier::where('id_utilisateur', Auth::id())->first();
        if (!$panier) return 0;
        
        return $panier->lignes()->sum('quantite');
    }
}
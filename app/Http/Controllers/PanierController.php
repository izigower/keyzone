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
        $lignes = $panier->lignes()->with('produit.plateforme')->get();
        $total = $panier->total;

        return view('panier.index', compact('lignes', 'total', 'panier'));
    }

    public function ajouter(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'integer|min:1|max:5',
        ]);

        $produit = Produit::findOrFail($validated['produit_id']);

        // Check stock
        if ($produit->stock_reel < 1) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Ce produit n\'est plus en stock'], 400);
            }
            return redirect()->back()->with('error', 'Ce produit n\'est plus en stock');
        }

        $panier = $this->getOrCreatePanier();
        $quantite = $validated['quantite'] ?? 1;

        $ligne = LignePanier::where('panier_id', $panier->id)
            ->where('produit_id', $validated['produit_id'])
            ->first();

        if ($ligne) {
            $newQty = $ligne->quantite + $quantite;
            if ($newQty > $produit->stock_reel) {
                $newQty = $produit->stock_reel;
            }
            $ligne->quantite = min($newQty, 5);
            $ligne->save();
        } else {
            LignePanier::create([
                'panier_id' => $panier->id,
                'produit_id' => $validated['produit_id'],
                'quantite' => min($quantite, $produit->stock_reel),
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Produit ajouté au panier',
                'count' => $this->getPanierCount()
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier');
    }

    public function supprimer($id)
    {
        $ligne = LignePanier::where('id', $id)
            ->whereHas('panier', function ($q) {
                $q->where('user_id', Auth::id());
            })->firstOrFail();

        $ligne->delete();
        return redirect()->back()->with('success', 'Article supprimé du panier');
    }

    public function mettreAJour(Request $request, $id)
    {
        $validated = $request->validate([
            'quantite' => 'required|integer|min:1|max:5',
        ]);

        $ligne = LignePanier::where('id', $id)
            ->whereHas('panier', function ($q) {
                $q->where('user_id', Auth::id());
            })->firstOrFail();

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
        return Panier::firstOrCreate(['user_id' => Auth::id()]);
    }

    private function getPanierCount()
    {
        $panier = Panier::where('user_id', Auth::id())->first();
        if (!$panier) return 0;
        return $panier->lignes()->sum('quantite');
    }
}

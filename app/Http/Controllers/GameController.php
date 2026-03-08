<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CategorieProduit;
use App\Models\Plateforme;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Produit::with(['categorie', 'plateforme'])->where('is_active', true);

        // Filter by category
        if ($request->filled('categorie')) {
            $query->whereHas('categorie', function ($q) use ($request) {
                $q->where('slug', $request->categorie);
            });
        }

        // Filter by platform
        if ($request->filled('plateforme')) {
            $query->whereHas('plateforme', function ($q) use ($request) {
                $q->where('slug', $request->plateforme);
            });
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('tri', 'recent');
        switch ($sort) {
            case 'prix_asc': $query->orderBy('prix', 'asc'); break;
            case 'prix_desc': $query->orderBy('prix', 'desc'); break;
            case 'nom': $query->orderBy('nom', 'asc'); break;
            default: $query->orderBy('created_at', 'desc');
        }

        $produits = $query->paginate(12);
        $categories = CategorieProduit::withCount('produits')->get();
        $plateformes = Plateforme::all();

        return view('games.index', compact('produits', 'categories', 'plateformes'));
    }

    public function show($slug)
    {
        $produit = Produit::with(['categorie', 'plateforme', 'commentaires.user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $similaires = Produit::where('categorie_id', $produit->categorie_id)
            ->where('id', '!=', $produit->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('games.show', compact('produit', 'similaires'));
    }
}

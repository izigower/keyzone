<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\CategorieProduit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $tendances = Produit::with(['categorie', 'plateforme'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $categories = CategorieProduit::withCount('produits')->get();

        return view('home', compact('tendances', 'categories'));
    }
}

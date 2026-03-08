<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Logique temporaire pour le panier
        return response()->json(['success' => true, 'message' => 'Produit ajouté au panier']);
    }
}
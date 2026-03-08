<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::where('user_id', Auth::id())
            ->with('lignes.produit', 'paiement', 'cles.produit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('lignes.produit.plateforme', 'paiement', 'cles.produit')
            ->firstOrFail();

        return view('commandes.show', compact('commande'));
    }
}

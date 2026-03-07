<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaiementController extends Controller
{
    public function checkout()
    {
        $panier = Panier::where('id_utilisateur', Auth::id())
            ->with('lignes.produit')
            ->first();

        if (!$panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }

        $total = $panier->total;

        return view('paiement.checkout', compact('panier', 'total'));
    }

    public function payer(Request $request)
    {
        $validated = $request->validate([
            'adresse_livraison' => 'required|string',
            'adresse_facturation' => 'required|string',
            'mode_paiement' => 'required|in:carte,paypal,virement',
        ]);

        $panier = Panier::where('id_utilisateur', Auth::id())
            ->with('lignes.produit')
            ->first();

        if (!$panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }

        DB::beginTransaction();

        try {
            $commande = Commande::create([
                'id_utilisateur' => Auth::id(),
                'date_commande' => now(),
                'montant_total' => $panier->total,
                'adresse_livraison' => $validated['adresse_livraison'],
                'adresse_facturation' => $validated['adresse_facturation'],
                'mode_paiement' => $validated['mode_paiement'],
                'statut' => 'en_attente',
            ]);

            // Créer les lignes de commande
            foreach ($panier->lignes as $ligne) {
                LigneCommande::create([
                    'id_commande' => $commande->id_commande,
                    'id_produit' => $ligne->id_produit,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire' => $ligne->produit->prix,
                ]);
            }

            // Vider le panier
            $panier->lignes()->delete();

            DB::commit();

            // Rediriger vers le paiement Stripe
            return redirect()->route('paiement.stripe', ['id_commande' => $commande->id_commande]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    public function stripe($id_commande)
    {
        $commande = Commande::findOrFail($id_commande);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $commande->lignes->map(function($ligne) {
                return [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $ligne->produit->nom_produit,
                        ],
                        'unit_amount' => $ligne->prix_unitaire * 100,
                    ],
                    'quantity' => $ligne->quantite,
                ];
            })->toArray(),
            'mode' => 'payment',
            'success_url' => route('paiement.succes', ['id_commande' => $id_commande]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('paiement.annule'),
            'client_reference_id' => $commande->id_commande,
        ]);

        return redirect($session->url);
    }

    public function succes($id_commande, Request $request)
    {
        $commande = Commande::findOrFail($id_commande);

        Paiement::create([
            'id_commande' => $id_commande,
            'montant' => $commande->montant_total,
            'date_paiement' => now(),
            'methode' => $commande->mode_paiement,
            'statut' => 'succes',
            'transaction_id' => $request->session_id,
        ]);

        $commande->statut = 'payee';
        $commande->save();

        return view('paiement.succes', compact('commande'));
    }

    public function annule()
    {
        return view('paiement.annule');
    }
}
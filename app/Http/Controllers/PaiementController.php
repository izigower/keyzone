<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Paiement;
use App\Models\CleJeu;
use App\Models\CodePromo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaiementController extends Controller
{
    public function checkout()
    {
        $panier = Panier::where('user_id', Auth::id())
            ->with('lignes.produit.plateforme')
            ->first();

        if (!$panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }

        $total = $panier->total;
        return view('paiement.checkout', compact('panier', 'total'));
    }

    public function appliquerPromo(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $codePromo = CodePromo::where('code', $request->code)->first();

        if (!$codePromo || !$codePromo->isValide()) {
            return response()->json(['success' => false, 'message' => 'Code promo invalide ou expiré']);
        }

        $panier = Panier::where('user_id', Auth::id())->with('lignes.produit')->first();
        $total = $panier->total;
        $reduction = $codePromo->calculerReduction($total);
        $totalReduit = $total - $reduction;

        session(['code_promo_id' => $codePromo->id]);

        return response()->json([
            'success' => true,
            'message' => 'Code promo appliqué !',
            'reduction' => number_format($reduction, 2),
            'total_reduit' => number_format($totalReduit, 2),
            'code' => $codePromo->code,
        ]);
    }

    public function payer(Request $request)
    {
        $panier = Panier::where('user_id', Auth::id())
            ->with('lignes.produit')
            ->first();

        if (!$panier || $panier->lignes->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }

        // Check stock for all items
        foreach ($panier->lignes as $ligne) {
            $stockDispo = $ligne->produit->clesDisponibles()->count();
            if ($stockDispo < $ligne->quantite) {
                return redirect()->route('panier.index')->with('error', "Stock insuffisant pour {$ligne->produit->nom}. Disponible: {$stockDispo}");
            }
        }

        $total = $panier->total;
        $montantReduit = null;
        $codePromoId = session('code_promo_id');

        if ($codePromoId) {
            $codePromo = CodePromo::find($codePromoId);
            if ($codePromo && $codePromo->isValide()) {
                $reduction = $codePromo->calculerReduction($total);
                $montantReduit = $total - $reduction;
            }
        }

        $montantFinal = $montantReduit ?? $total;

        DB::beginTransaction();

        try {
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'montant_total' => $total,
                'montant_reduit' => $montantReduit,
                'code_promo_id' => $codePromoId,
                'statut' => 'en_attente',
            ]);

            foreach ($panier->lignes as $ligne) {
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $ligne->produit_id,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire' => $ligne->produit->prix,
                ]);
            }

            DB::commit();

            // Increment promo usage
            if ($codePromoId) {
                CodePromo::where('id', $codePromoId)->increment('utilisations_count');
                session()->forget('code_promo_id');
            }

            // Redirect to Stripe
            return $this->createStripeSession($commande, $montantFinal);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors de la commande: ' . $e->getMessage());
        }
    }

    private function createStripeSession(Commande $commande, float $montantFinal)
    {
        $stripeKey = config('services.stripe.secret');

        if (!$stripeKey) {
            // Fallback: simulate success for demo without Stripe
            return $this->simulerPaiementSucces($commande);
        }

        Stripe::setApiKey($stripeKey);

        $lineItems = [];
        $commande->load('lignes.produit');

        foreach ($commande->lignes as $ligne) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $ligne->produit->nom,
                        'images' => $ligne->produit->image ? [$ligne->produit->image] : [],
                    ],
                    'unit_amount' => (int) round($ligne->prix_unitaire * 100),
                ],
                'quantity' => $ligne->quantite,
            ];
        }

        // Apply discount if promo code
        $discounts = [];
        if ($commande->montant_reduit && $commande->montant_reduit < $commande->montant_total) {
            // Create a coupon on-the-fly
            $coupon = \Stripe\Coupon::create([
                'amount_off' => (int) round(($commande->montant_total - $commande->montant_reduit) * 100),
                'currency' => 'eur',
                'duration' => 'once',
            ]);
            $discounts[] = ['coupon' => $coupon->id];
        }

        $sessionParams = [
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('paiement.succes', ['id' => $commande->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('paiement.annule', ['id' => $commande->id]),
            'client_reference_id' => (string) $commande->id,
            'customer_email' => Auth::user()->email,
            'metadata' => [
                'commande_id' => $commande->id,
                'numero_commande' => $commande->numero_commande,
            ],
        ];

        if (!empty($discounts)) {
            $sessionParams['discounts'] = $discounts;
        }

        $session = Session::create($sessionParams);

        $commande->update(['stripe_session_id' => $session->id]);

        return redirect($session->url);
    }

    private function simulerPaiementSucces(Commande $commande)
    {
        // For demo without Stripe key
        $this->finaliserCommande($commande, 'demo_' . uniqid());
        return redirect()->route('paiement.succes', ['id' => $commande->id]);
    }

    public function succes($id, Request $request)
    {
        $commande = Commande::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('lignes.produit', 'cles')
            ->firstOrFail();

        if ($commande->statut === 'en_attente') {
            $sessionId = $request->get('session_id', 'direct_' . uniqid());
            $this->finaliserCommande($commande, $sessionId);
            $commande->refresh();
            $commande->load('cles.produit');
        }

        return view('paiement.succes', compact('commande'));
    }

    private function finaliserCommande(Commande $commande, string $transactionId)
    {
        DB::transaction(function () use ($commande, $transactionId) {
            // Create payment record
            Paiement::create([
                'commande_id' => $commande->id,
                'montant' => $commande->montant_reduit ?? $commande->montant_total,
                'methode' => 'stripe',
                'statut' => 'succes',
                'stripe_session_id' => $transactionId,
            ]);

            $commande->update(['statut' => 'payee']);

            // Assign game keys
            foreach ($commande->lignes as $ligne) {
                $cles = CleJeu::where('produit_id', $ligne->produit_id)
                    ->where('statut', 'disponible')
                    ->take($ligne->quantite)
                    ->get();

                foreach ($cles as $cle) {
                    $cle->update([
                        'statut' => 'vendue',
                        'commande_id' => $commande->id,
                        'user_id' => $commande->user_id,
                        'vendue_at' => now(),
                    ]);
                }
            }

            // Clear cart
            $panier = Panier::where('user_id', $commande->user_id)->first();
            if ($panier) {
                $panier->lignes()->delete();
            }
        });

        // Send confirmation email
        $this->envoyerEmailConfirmation($commande);
    }

    private function envoyerEmailConfirmation(Commande $commande)
    {
        try {
            $commande->load('cles.produit', 'user', 'lignes.produit');
            Mail::to($commande->user->email)->send(new \App\Mail\CommandeConfirmee($commande));
        } catch (\Exception $e) {
            \Log::error('Email confirmation failed: ' . $e->getMessage());
        }
    }

    public function annule($id = null)
    {
        if ($id) {
            $commande = Commande::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();
            if ($commande && $commande->statut === 'en_attente') {
                $commande->update(['statut' => 'annulee']);
            }
        }
        return view('paiement.annule');
    }
}

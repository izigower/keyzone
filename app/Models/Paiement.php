<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'commande_id',
        'montant',
        'methode',
        'statut',
        'stripe_payment_intent_id',
        'stripe_session_id',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}

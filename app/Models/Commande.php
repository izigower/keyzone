<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'numero_commande',
        'user_id',
        'montant_total',
        'montant_reduit',
        'code_promo_id',
        'adresse_livraison',
        'adresse_facturation',
        'statut',
        'stripe_session_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($commande) {
            if (empty($commande->numero_commande)) {
                $commande->numero_commande = 'CMD-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    public function codePromo()
    {
        return $this->belongsTo(CodePromo::class);
    }

    public function cles()
    {
        return $this->hasMany(CleJeu::class);
    }
}

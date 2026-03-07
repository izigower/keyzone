<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commande';
    protected $primaryKey = 'id_commande';
    public $timestamps = false;

    protected $fillable = [
        'numero_commande',
        'id_utilisateur',
        'date_commande',
        'montant_total',
        'adresse_livraison',
        'adresse_facturation',
        'mode_paiement',
        'statut',
    ];

    protected $casts = [
        'date_commande' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommande::class, 'id_ligne', 'id_commande');
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'id_commande', 'id_commande');
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($commande) {
            $commande->numero_commande = 'CMD-' . strtoupper(uniqid());
        });
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $table = 'panier';
    protected $primaryKey = 'id_panier';
    public $timestamps = false;

    protected $fillable = [
        'id_utilisateur',
        'date_creation',
        'date_modification',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function lignes()
    {
        return $this->hasMany(LignePanier::class, 'id_panier', 'id_panier');
    }

    public function getTotalAttribute()
    {
        return $this->lignes->sum(function($ligne) {
            return $ligne->produit->prix * $ligne->quantite;
        });
    }
}
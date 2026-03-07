<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LignePanier extends Model
{
    protected $table = 'ligne_panier';
    protected $primaryKey = 'id_ligne_panier';
    public $timestamps = false;

    protected $fillable = [
        'id_panier',
        'id_produit',
        'quantite',
    ];

    public function panier()
    {
        return $this->belongsTo(Panier::class, 'id_panier', 'id_panier');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id_produit');
    }
}
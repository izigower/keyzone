<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LignePanier extends Model
{
    protected $fillable = [
        'panier_id',
        'produit_id',
        'quantite',
    ];

    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function getSousTotalAttribute()
    {
        return $this->produit->prix * $this->quantite;
    }
}

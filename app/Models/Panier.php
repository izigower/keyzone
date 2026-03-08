<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lignes()
    {
        return $this->hasMany(LignePanier::class);
    }

    public function getTotalAttribute()
    {
        return $this->lignes->sum(function ($ligne) {
            return $ligne->produit->prix * $ligne->quantite;
        });
    }

    public function getNombreArticlesAttribute()
    {
        return $this->lignes->sum('quantite');
    }
}

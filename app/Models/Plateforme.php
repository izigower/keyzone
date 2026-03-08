<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Plateforme extends Model
{
    protected $fillable = ['nom', 'slug', 'icone'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($plateforme) {
            if (empty($plateforme->slug)) {
                $plateforme->slug = Str::slug($plateforme->nom);
            }
        });
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'plateforme_id');
    }
}

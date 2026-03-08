<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategorieProduit extends Model
{
    protected $table = 'categorie_produits';

    protected $fillable = [
        'nom',
        'description',
        'slug',
        'image',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($categorie) {
            if (empty($categorie->slug)) {
                $categorie->slug = Str::slug($categorie->nom);
            }
        });
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }
}

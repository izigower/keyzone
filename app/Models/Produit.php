<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'slug',
        'description',
        'prix',
        'prix_original',
        'image',
        'categorie_id',
        'plateforme_id',
        'stock',
        'badge',
        'age_rating',
        'is_active',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'prix_original' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($produit) {
            if (empty($produit->slug)) {
                $produit->slug = Str::slug($produit->nom);
            }
        });
    }

    public function categorie()
    {
        return $this->belongsTo(CategorieProduit::class, 'categorie_id');
    }

    public function plateforme()
    {
        return $this->belongsTo(Plateforme::class);
    }

    public function clesDisponibles()
    {
        return $this->hasMany(CleJeu::class)->where('statut', 'disponible');
    }

    public function cles()
    {
        return $this->hasMany(CleJeu::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function getStockReelAttribute()
    {
        return $this->clesDisponibles()->count();
    }

    public function getReductionAttribute()
    {
        if ($this->prix_original && $this->prix_original > $this->prix) {
            return round((1 - $this->prix / $this->prix_original) * 100);
        }
        return 0;
    }

    public function getNoteMoyenneAttribute()
    {
        return $this->commentaires()->whereNotNull('note')->avg('note') ?? 0;
    }
}

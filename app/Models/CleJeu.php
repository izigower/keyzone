<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleJeu extends Model
{
    protected $table = 'cles_jeu';

    protected $fillable = [
        'produit_id',
        'cle',
        'statut',
        'commande_id',
        'user_id',
        'vendue_at',
    ];

    protected $casts = [
        'vendue_at' => 'datetime',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiement';
    protected $primaryKey = 'id_paiement';
    public $timestamps = false;

    protected $fillable = [
        'id_commande',
        'montant',
        'date_paiement',
        'methode',
        'statut',
        'transaction_id',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'id_commande', 'id_commande');
    }
}
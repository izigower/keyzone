<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodePromo extends Model
{
    protected $fillable = [
        'code',
        'type',
        'valeur',
        'utilisations_max',
        'utilisations_count',
        'date_debut',
        'date_fin',
        'is_active',
    ];

    protected $casts = [
        'valeur' => 'decimal:2',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean',
    ];

    public function isValide(): bool
    {
        if (!$this->is_active) return false;
        if ($this->utilisations_max && $this->utilisations_count >= $this->utilisations_max) return false;
        if ($this->date_debut && now()->lt($this->date_debut)) return false;
        if ($this->date_fin && now()->gt($this->date_fin)) return false;
        return true;
    }

    public function calculerReduction(float $montant): float
    {
        if ($this->type === 'pourcentage') {
            return round($montant * ($this->valeur / 100), 2);
        }
        return min($this->valeur, $montant);
    }
}

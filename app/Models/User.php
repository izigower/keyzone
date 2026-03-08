<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'date_naissance',
        'avatar',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_naissance' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function panier()
    {
        return $this->hasOne(Panier::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function clesJeu()
    {
        return $this->hasMany(CleJeu::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = strtolower($value);
    }

    // Désactiver le canal mail
    public function routeNotificationForMail($notification)
    {
        return false; // Empêche l'envoi d'emails
    }
}
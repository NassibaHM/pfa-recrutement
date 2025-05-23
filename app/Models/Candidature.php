<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'offre_id',
        'competences_techniques',
        'competences_linguistiques',
        'competences_manageriales',
        'experience',
        'nom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'formation',
        'certifications',
        'autres_informations',
        'photo',
        'etat',
        'score',
        'retained'
    ];

    protected $casts = [
        'retained' => 'boolean',
    ];

    // Relations avec Offre et User
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function statuses()
    {
        return $this->hasMany(CandidatureStatus::class);
    }

    public function getEtatBadgeColor()
    {
        return match($this->etat) {
            'accepté' => 'bg-green-100 text-green-800',
            'refusé' => 'bg-red-100 text-red-800',
            'en attente' => 'bg-yellow-100 text-yellow-800',
            'validation' => 'bg-blue-100 text-blue-800',
            'entretien RH' => 'bg-purple-100 text-purple-800',
            'test technique' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
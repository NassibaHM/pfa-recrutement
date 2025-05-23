<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    // Spécifie les colonnes qui peuvent être assignées en masse
    protected $fillable = [
        'profile', 
        'description', 
        'formation',
        'competences_techniques', 
        'competences_linguistiques', 
        'competences_manageriales',
        'experience', 
        'date_entretien', 
        'date_selection'
    ];
    public function criteres()
    {
        return $this->hasOne(Critere::class);
    }
    // Si tu souhaites définir des relations, tu peux les ajouter ici.
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}

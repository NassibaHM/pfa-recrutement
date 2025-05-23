<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    use HasFactory;

    protected $table = 'criteres';

    protected $fillable = [
        'description',
        'nombre_candidats',
        'date_selection',
        'date_entretien',
        'date_test',
        'local_entretien',
        'pieces_apporter',
        'competences_techniques',
        'competences_linguistiques',
        'competences_manageriales',
        'formation',
        'experience',
        'poids_competence_technique',   // Ajoute ces champs
        'poids_competence_linguistique',
        'poids_competence_manageriale',
        'poids_formation',
        'poids_experience',
        'profile', 
        'offre_id',

    ];

    protected $casts = [
        'formation' => 'array', // Formations sélectionnées (niveau, domaine, etc.)
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

}

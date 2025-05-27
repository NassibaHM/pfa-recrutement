<?php
namespace Database\Seeders;
use App\Models\Offre;
use App\Models\Critere;
use Illuminate\Database\Seeder;

class OffreCritereSeeder extends Seeder
{
    public function run(): void
    {
        $offre = Offre::create([
            'titre' => 'Développeur Full Stack',
            'description' => 'Poste de développeur full stack.',
        ]);

        Critere::create([
            'offre_id' => $offre->id,
            'competences_techniques' => 'Python, Java',
            'competences_linguistiques' => 'English, French',
            'competences_manageriales' => 'Leadership',
            'formation' => json_encode(['Master', 'Ingénieur']),
            'experience' => 5,
            'poids_competence_technique' => 30,
            'poids_competence_linguistique' => 20,
            'poids_competence_manageriale' => 20,
            'poids_formation' => 15,
            'poids_experience' => 15,
        ]);
    }
}
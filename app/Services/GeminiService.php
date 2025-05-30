<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function rankCandidates(array $candidates, array $criteria, array $critere)
    {
        $results = [];
        foreach ($candidates as $candidate) {
            $prompt = $this->buildPrompt($candidate, $criteria, $critere);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("{$this->baseUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
            ]);

            if ($response->failed()) {
                throw new \Exception('Erreur lors de l\'appel à l\'API Gemini : ' . $response->body());
            }

            $result = $response->json();
            $score = $this->parseScore($result);
            $features = $this->extractFeatures($candidate, $critere, $score);

            $results[] = [
                'score' => $score,
                'features' => $features,
                'candidature_id' => $candidate['candidature_id'] ?? null,
            ];
        }

        usort($results, fn($a, $b) => $b['score'] - $a['score']);
        return $results;
    }

    protected function buildPrompt($candidate, $criteria, $critere)
    {
        $candidateText = "Candidat : " . json_encode([
            'competences_techniques' => $candidate['competences_techniques'] ?? '',
            'competences_linguistiques' => $candidate['competences_linguistiques'] ?? '',
            'competences_manageriales' => $candidate['competences_manageriales'] ?? '',
            'formation' => $candidate['formation'] ?? '',
            'experience' => $candidate['experience'] ?? 0,
        ]);
        $critereText = "Critères : " . json_encode($critere);
        $criteriaText = "Poids : " . json_encode($criteria);

        return "Évaluez la pertinence de ce candidat par rapport aux critères et pondérations donnés. Calculez un score entre 0 et 1 basé sur :\n" .
               "- Compétences techniques (poids : {$criteria['poids_competence_technique']}%) : correspondance entre les compétences techniques du candidat et celles requises.\n" .
               "- Compétences linguistiques (poids : {$criteria['poids_competence_linguistique']}%) : correspondance entre les compétences linguistiques.\n" .
               "- Compétences managériales (poids : {$criteria['poids_competence_manageriale']}%) : correspondance entre les compétences managériales.\n" .
               "- Formation (poids : {$criteria['poids_formation']}%) : correspondance exacte avec la formation requise.\n" .
               "- Expérience (poids : {$criteria['poids_experience']}%) : rapport entre l'expérience du candidat et celle requise (max 1).\n" .
               "Retournez uniquement le score final entre 0 et 1, sans texte supplémentaire.\n\n{$candidateText}\n\n{$critereText}\n\n{$criteriaText}";
    }

    protected function parseScore($result)
    {
        $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
        if (!$text || !is_numeric($text)) {
            throw new \Exception('Score invalide retourné par Gemini');
        }
        return min(floatval($text), 1.0); // Limite à 1
    }

    protected function extractFeatures($candidate, $critere, $score)
    {
        $features = [];
        $techSkills = explode(',', strtolower($candidate['competences_techniques'] ?? ''));
        $requiredTech = explode(',', strtolower($critere['competences_techniques'] ?? ''));
        $features['technical_skills'] = array_intersect(array_filter($techSkills), array_filter($requiredTech));

        $langSkills = explode(',', strtolower($candidate['competences_linguistiques'] ?? ''));
        $requiredLang = explode(',', strtolower($critere['competences_linguistiques'] ?? ''));
        $features['linguistic_skills'] = array_intersect(array_filter($langSkills), array_filter($requiredLang));

        $mgrSkills = explode(',', strtolower($candidate['competences_manageriales'] ?? ''));
        $requiredMgr = explode(',', strtolower($critere['competences_manageriales'] ?? ''));
        $features['managerial_skills'] = array_intersect(array_filter($mgrSkills), array_filter($requiredMgr));

        $features['formation'] = $critere['formation'] && $candidate['formation'] ? 
            (in_array($candidate['formation'], (array)$critere['formation']) ? 1 : 0) : 0;

        $features['experience'] = $critere['experience'] ? min($candidate['experience'] / $critere['experience'], 1) : 0;

        return $features;
    }
}
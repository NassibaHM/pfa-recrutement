<?php
namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ResumeAnalyzerController extends Controller
{
    public function rank(Request $request, $critereId)
    {
        try {
            Log::info('Starting ranking process', ['critere_id' => $critereId]);

            $critere = Critere::findOrFail($critereId);
            $candidatures = Candidature::where('offre_id', $critere->offre_id)->get();

            if ($candidatures->isEmpty()) {
                Log::warning('No candidatures found for offre_id', ['offre_id' => $critere->offre_id]);
                return redirect()->back()->with('error', 'Aucune candidature pour cette offre.');
            }

            $candidatesData = [];
            foreach ($candidatures as $candidature) {
                if (empty($candidature->formation) || empty($candidature->experience) || empty($candidature->competences_techniques)) {
                    Log::warning('Incomplete candidate data', [
                        'candidature_id' => $candidature->id,
                        'formation' => $candidature->formation,
                        'experience' => $candidature->experience,
                        'competences_techniques' => $candidature->competences_techniques,
                    ]);
                    continue;
                }
                $candidatesData[] = [
                    'candidature_id' => $candidature->id,
                    'formation' => $candidature->formation,
                    'experience' => (int) $candidature->experience,
                    'competences_techniques' => $candidature->competences_techniques,
                    'competences_linguistiques' => $candidature->competences_linguistiques ?? '',
                    'competences_manageriales' => $candidature->competences_manageriales ?? '',
                    'certifications' => $candidature->certifications ?? '',
                ];
            }

            Log::info('Candidates data prepared', ['candidates_count' => count($candidatesData), 'data' => $candidatesData]);

            if (empty($candidatesData)) {
                Log::warning('No valid candidate data for ranking');
                return redirect()->back()->with('error', 'Aucune candidature avec des données valides pour le classement.');
            }

            $criteria = [
                'poids_competence_technique' => $critere->poids_competence_technique,
                'poids_competence_linguistique' => $critere->poids_competence_linguistique,
                'poids_competence_manageriale' => $critere->poids_competence_manageriale,
                'poids_formation' => $critere->poids_formation,
                'poids_experience' => $critere->poids_experience,
            ];

            $payload = [
                'candidates' => $candidatesData,
                'criteria' => $criteria,
                'critere' => $critere->toArray(),
            ];

            Log::info('Sending request to ranking API', ['payload' => $payload]);

            $response = Http::timeout(30)->post('http://localhost:3000/rank', $payload);

            if ($response->failed()) {
                Log::error('API ranking failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return redirect()->back()->with('error', 'Erreur lors du classement des candidats : ' . $response->body());
            }

            $results = $response->json();

            Log::info('API response received', ['results' => $results]);

            if (!is_array($results) || empty($results)) {
                Log::error('Invalid or empty API response', ['results' => $results]);
                return redirect()->back()->with('error', 'Réponse invalide ou vide de l\'API de classement.');
            }

            foreach ($results as $index => $result) {
                if (!isset($result['candidature_id'], $result['score'])) {
                    Log::warning('Invalid result format', ['result' => $result]);
                    continue;
                }
                $candidature = Candidature::find($result['candidature_id']);
                if ($candidature) {
                    $candidature->update([
                        'score' => $result['score'] ?? null,
                        'rank' => $index + 1,
                        'extracted_features' => json_encode($result['features'] ?? []),
                    ]);
                    Log::info('Updated candidature', [
                        'candidature_id' => $candidature->id,
                        'score' => $result['score'],
                        'rank' => $index + 1,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Candidats classés avec succès.');
        } catch (\Exception $e) {
            Log::error('Error in ResumeAnalyzerController::rank', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Erreur lors du classement : ' . $e->getMessage());
        }
    }
}
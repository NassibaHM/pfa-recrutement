<?php
namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Candidature;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResumeAnalyzerController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

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

            // Appeler GeminiService pour obtenir les scores
            $results = $this->geminiService->rankCandidates($candidatesData, $criteria, $critere->toArray());

            Log::info('Ranking results received from Gemini', ['results' => $results]);

            if (!is_array($results) || empty($results)) {
                Log::error('Invalid or empty ranking results from Gemini', ['results' => $results]);
                return redirect()->back()->with('error', 'Résultats de classement invalides ou vides.');
            }

            // Mettre à jour les scores et rangs dans la base de données
            foreach ($results as $index => $result) {
                if (!isset($result['candidature_id'], $result['score'])) {
                    Log::warning('Invalid result format from Gemini', ['result' => $result]);
                    continue;
                }

                $candidature = Candidature::find($result['candidature_id']);
                if ($candidature) {
                    $candidature->update([
                        'score_pertinence' => $result['score'] * 100, // Utiliser score_pertinence au lieu de score
                        'rank' => $index + 1,
                        'extracted_features' => json_encode($result['features'] ?? []),
                    ]);
                    Log::info('Updated candidature with Gemini score', [
                        'candidature_id' => $candidature->id,
                        'score_pertinence' => $result['score'] * 100,
                        'rank' => $index + 1,
                    ]);
                }
            }

            // Récupérer les candidatures triées par score_pertinence descendant
            $sortedCandidatures = Candidature::where('offre_id', $critere->offre_id)
                ->orderByDesc('score_pertinence')
                ->get();

            // Récupérer les offres et critères pour la vue
            $offres = \App\Models\Offre::all();
            $criteres = \App\Models\Critere::orderBy('id', 'desc')->get();

            // Passer les données triées à la vue
            return view('candidats.index-recruteur', [
                'offres' => $offres,
                'criteres' => $criteres,
                'candidatures' => $sortedCandidatures,
                'offreId' => $critere->offre_id,
            ])->with('success', 'Candidats classés avec succès.');

        } catch (\Exception $e) {
            Log::error('Error in ResumeAnalyzerController::rank', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Erreur lors du classement : ' . $e->getMessage());
        }
    }
}
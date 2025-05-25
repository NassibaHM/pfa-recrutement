<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Critere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CandidatureController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $candidatures = Candidature::where('user_id', $user->id)->with('offre')->get();
        return view('candidatures.index', compact('candidatures'));
    }

    public function create($id)
    {
        $offre = Critere::findOrFail($id);
        $hasApplied = Auth::check() && Candidature::where('user_id', Auth::id())
            ->where('offre_id', $offre->id)
            ->exists();

        if ($hasApplied) {
            return redirect()->route('candidat.offres')->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        return view('candidats.candidatures.create', compact('offre'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'email' => 'required|email',
                'telephone' => 'required|string|max:20',
                'adresse' => 'nullable|string',
                'date_naissance' => 'nullable|date',
                'formation' => 'nullable|string',
                'experience' => 'nullable|string',
                'competences_techniques' => 'nullable|string',
                'competences_linguistiques' => 'nullable|string',
                'competences_manageriales' => 'nullable|string',
                'certifications' => 'nullable|string',
                'autres_informations' => 'nullable|string',
                'offre_id' => 'required|exists:criteres,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $hasApplied = Candidature::where('user_id', Auth::id())
                ->where('offre_id', $validated['offre_id'])
                ->exists();

            if ($hasApplied) {
                return redirect()->route('candidat.offres')->with('error', 'Vous avez déjà postulé à cette offre.');
            }

            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            Candidature::create([
                'user_id' => Auth::id(),
                'offre_id' => $validated['offre_id'],
                'nom' => $validated['nom'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'adresse' => $validated['adresse'],
                'date_naissance' => $validated['date_naissance'],
                'formation' => $validated['formation'],
                'experience' => $validated['experience'],
                'competences_techniques' => $validated['competences_techniques'],
                'competences_linguistiques' => $validated['competences_linguistiques'],
                'competences_manageriales' => $validated['competences_manageriales'],
                'certifications' => $validated['certifications'],
                'autres_informations' => $validated['autres_informations'],
                'photo' => $photoPath,
                'etat' => 'en attente',
            ]);

            Log::info('Candidature created successfully, redirecting to success page.', [
                'offre_id' => $validated['offre_id'],
                'user_id' => Auth::id()
            ]);

            return redirect()->route('candidature.success')->with('success', 'Candidature envoyée avec succès !');
        } catch (\Exception $e) {
            Log::error('Error in CandidatureController@store: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('candidats.candidatures.success');
    }

    public function mesPostes()
    {
        $user = Auth::user();
        $candidatures = Candidature::with(['offre'])->where('user_id', $user->id)->get();
        return view('candidats.mes-postes', compact('candidatures'));
    }

    public function show($id)
    {
        $candidature = Candidature::findOrFail($id);
        return view('candidature.show', compact('candidature'));
    }

    public function voirDetails($id)
    {
        $candidature = Candidature::with('offre')->findOrFail($id);
        $offre = $candidature->offre;
        return view('candidatures.details', compact('candidature', 'offre'));
    }

    public function afficherCandidatures($offre_id)
    {
        $offre = Critere::findOrFail($offre_id);
        $candidatures = $offre->candidatures()->with('user')->orderByDesc('score')->get();
        return view('offres.candidatures', compact('offre', 'candidatures'));
    }

    public function postuler(Request $request, $offre_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter avant de postuler.');
        }

        $offre = Critere::findOrFail($offre_id);

        $validated = $request->validate([
            'competences_techniques' => 'required|numeric',
            'competences_linguistiques' => 'required|numeric',
            'competences_manageriales' => 'required|numeric',
            'experience' => 'required|numeric',
            'nom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
            'date_naissance' => 'required|date',
            'formation' => 'required|string',
            'certifications' => 'nullable|string',
            'autres_informations' => 'nullable|string',
        ]);

        $exist = Candidature::where('offre_id', $offre_id)
            ->where('user_id', Auth::id())->first();
        if ($exist) {
            return back()->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        $candidature = new Candidature();
        $candidature->fill($validated);
        $candidature->offre_id = $offre_id;
        $candidature->user_id = Auth::id();
        $candidature->etat = 'en attente';
        $candidature->score = $this->calculerScore($candidature, $offre);

        $candidature->save();

        return redirect()->route('candidat.offres')->with('success', 'Candidature envoyée avec succès !');
    }

    private function calculerScore($candidature, $offre)
    {
        $critere = $offre; // Critere is the offer itself
        if (!$critere) return 0;

        $score = 0;
        $score += $this->calculerCritereScore($candidature->competences_techniques, $critere->poids_competence_technique);
        $score += $this->calculerCritereScore($candidature->competences_linguistiques, $critere->poids_competence_linguistique);
        $score += $this->calculerCritereScore($candidature->competences_manageriales, $critere->poids_competence_manageriale);
        $score += $this->calculerCritereScore($candidature->experience, $critere->poids_experience);
        $score += $this->calculerCritereScore($candidature->formation, $critere->poids_formation);

        return $score;
    }

    private function calculerCritereScore($valeurCandidat, $poidsCritere)
    {
        return is_numeric($valeurCandidat) ? (int)$valeurCandidat * (int)$poidsCritere : 0;
    }
}

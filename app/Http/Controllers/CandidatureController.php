<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CandidatureController extends Controller
{
    // Affiche les candidatures du candidat connecté
    public function index()
    {
        $user = Auth::user();
        $candidatures = Candidature::where('user_id', $user->id)->with('offre')->get();
        return view('candidatures.index', compact('candidatures'));
    }

    // Formulaire de candidature
    public function create($id)
    {
        $offre = Offre::findOrFail($id);
        return view('candidats.candidatures.create', compact('offre'));
    }

    // Sauvegarder une nouvelle candidature (via formulaire de base avec fichier image)
    public function store(Request $request)
    {
        try {
            $request->validate([
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
                'offre_id' => 'required|exists:offres,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            Candidature::create([
                'user_id' => Auth::id(),
                'offre_id' => $request->offre_id,
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'date_naissance' => $request->date_naissance,
                'formation' => $request->formation,
                'experience' => $request->experience,
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'certifications' => $request->certifications,
                'autres_informations' => $request->autres_informations,
                'photo' => $photoPath,
                'etat' => 'en attente',
            ]);

            // Log to confirm this point is reached
            Log::info('Candidature created successfully, redirecting to success page.', [
                'offre_id' => $request->offre_id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('candidature.success')->with('success', 'Candidature envoyée avec succès !');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error in CandidatureController@store: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // Vue de succès après soumission
    public function success()
    {
        return view('candidats.candidatures.success');
    }

    // Vue Mes Postes
    public function mesPostes()
    {
        $user = Auth::user();

        $candidatures = Candidature::with(['offre.criteres'])->where('user_id', $user->id)->get();

        return view('candidats.mes-postes', compact('candidatures'));
    }

    // Voir une candidature
    public function show($id)
    {
        $candidature = Candidature::findOrFail($id);
        return view('candidature.show', compact('candidature'));
    }

    // Détails d'une candidature
    public function voirDetails($id)
    {
        $candidature = Candidature::with('offre')->findOrFail($id);
        $offre = $candidature->offre;
        return view('candidatures.details', compact('candidature', 'offre'));
    }

    // Afficher les candidatures par offre (pour le recruteur)
    public function afficherCandidatures($offre_id)
    {
        $offre = Offre::findOrFail($offre_id);
        $candidatures = $offre->candidatures()->with('user')->orderByDesc('score')->get();

        return view('offres.candidatures', compact('offre', 'candidatures'));
    }

    // Postuler à une offre avec scoring
    public function postuler(Request $request, $offre_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter avant de postuler.');
        }

        $offre = Offre::findOrFail($offre_id);

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

        // Vérification double candidature
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

        return redirect()->route('offres.disponibles')->with('success', 'Candidature envoyée avec succès !');
    }

    private function calculerScore($candidature, $offre)
    {
        $critere = $offre->criteres()->first();

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
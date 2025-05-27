<?php
namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Critere;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $offre = Offre::findOrFail($id);
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
                'email' => 'required|email|max:255',
                'telephone' => 'required|string|max:20',
                'adresse' => 'nullable|string',
                'date_naissance' => 'nullable|date',
                'formation' => 'required|string',
                'experience' => 'required|numeric|min:0',
                'competences_techniques' => 'required|string',
                'competences_linguistiques' => 'required|string',
                'competences_manageriales' => 'nullable|string',
                'certifications' => 'nullable|string',
                'autres_informations' => 'nullable|string',
                'offre_id' => 'required|exists:offres,id',
                'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            $hasApplied = Candidature::where('user_id', Auth::id())
                ->where('offre_id', $validated['offre_id'])
                ->exists();

            if ($hasApplied) {
                return redirect()->route('candidat.offres')->with('error', 'Vous avez déjà postulé à cette offre.');
            }

            $photoPath = null;
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                if (!$photoPath) {
                    Log::error('Failed to store photo', ['user_id' => Auth::id()]);
                    return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la photo.');
                }
            }

            $candidature = Candidature::create([
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
                'resume_path' => null,
                'etat' => 'en attente',
            ]);

            Log::info('Candidature created successfully.', [
                'offre_id' => $validated['offre_id'],
                'user_id' => Auth::id(),
                'candidature_id' => $candidature->id,
            ]);

            return redirect()->route('candidature.success')->with('success', 'Candidature envoyée avec succès !');
        } catch (\Exception $e) {
            Log::error('Error in CandidatureController@store: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
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

    public function apply(Request $request, Offre $offre)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'formation' => 'required|string',
            'experience' => 'required|numeric|min:0',
            'competences_techniques' => 'required|string',
            'competences_linguistiques' => 'required|string',
            'competences_manageriales' => 'nullable|string',
            'certifications' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            $photoPath = null;
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            Candidature::create([
                'offre_id' => $offre->id,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'formation' => $request->formation,
                'experience' => $request->experience,
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'certifications' => $request->certifications,
                'photo' => $photoPath,
                'resume_path' => null,
                'user_id' => Auth::id(),
                'etat' => 'en attente',
            ]);

            return redirect()->route('candidature.success')->with('success', 'Candidature soumise avec succès.');
        } catch (\Exception $e) {
            Log::error('Error in CandidatureController@apply: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la candidature : ' . $e->getMessage());
        }
    }

    public function listCriteres()
    {
        $criteres = Critere::all();
        return view('recruteur.criteres', compact('criteres'));
    }

    public function listCandidatures(Offre $offre)
    {
        $candidatures = Candidature::where('offre_id', $offre->id)->get();
        return view('recruteur.candidatures', compact('offre', 'candidatures'));
    }

    public function listCandidats(Request $request, $offre_id = null)
    {
        $offres = Offre::all();
        $criteres = Critere::all();
        $candidatures = $offre_id
            ? Candidature::where('offre_id', $offre_id)->with('user')->get()
            : Candidature::with('user')->get();
        $offreId = $offre_id;
        return view('candidats.index-recruteur', compact('offres', 'candidatures', 'criteres', 'offreId'));
    }
}

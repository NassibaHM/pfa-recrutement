<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Critere;
use App\Models\Offre;
use Exception;

class CritereController extends Controller
{
    public function index(Request $request)
    {
        $searchProfile = $request->get('search_profile');

        $criteres = Critere::query()
            ->when($searchProfile, function ($query, $searchProfile) {
                return $query->where('profile', 'LIKE', '%' . $searchProfile . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('criteres.index', compact('criteres'));
    }

    public function create()
    {
        return view('criteres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'nombre_candidats' => 'required|integer|min:1',
            'date_selection' => 'required|date',
            'date_entretien' => 'required|date',
            'date_test' => 'required|date',
            'local_entretien' => 'required|string',
            'pieces_apporter' => 'required|string',
            'competences_techniques' => 'required|string',
            'competences_linguistiques' => 'required|string',
            'competences_manageriales' => 'required|string',
            'formation' => 'nullable|array',
            'formation.*' => 'string',
            'experience' => 'required|integer|min:0',
            'poids_competence_technique' => 'required|integer|min:0|max:100',
            'poids_competence_linguistique' => 'required|integer|min:0|max:100',
            'poids_competence_manageriale' => 'required|integer|min:0|max:100',
            'poids_formation' => 'required|integer|min:0|max:100',
            'poids_experience' => 'required|integer|min:0|max:100',
            'profile' => 'required|string',
        ]);

        $totalPonderation = 
            $request->poids_competence_technique +
            $request->poids_competence_linguistique +
            $request->poids_competence_manageriale +
            $request->poids_formation +
            $request->poids_experience;

        if ($totalPonderation !== 100) {
            return back()->withInput()->withErrors([
                'ponderation_total' => 'La somme des pondérations doit être exactement 100%. Actuellement : ' . $totalPonderation . '%'
            ]);
        }

        try {
            $offre = Offre::create([
                'profile' => $request->profile,
                'description' => $request->description,
                'formation' => json_encode($request->formation ?? []),
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'experience' => $request->experience,
                'date_entretien' => $request->date_entretien,
                'date_selection' => $request->date_selection,
            ]);

            $critere = Critere::create([
                'description' => $request->description,
                'nombre_candidats' => $request->nombre_candidats,
                'date_selection' => $request->date_selection,
                'date_entretien' => $request->date_entretien,
                'date_test' => $request->date_test,
                'local_entretien' => $request->local_entretien,
                'pieces_apporter' => $request->pieces_apporter,
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'formation' => json_encode($request->formation ?? []),
                'experience' => $request->experience,
                'poids_competence_technique' => $request->poids_competence_technique,
                'poids_competence_linguistique' => $request->poids_competence_linguistique,
                'poids_competence_manageriale' => $request->poids_competence_manageriale,
                'poids_formation' => $request->poids_formation,
                'poids_experience' => $request->poids_experience,
                'profile' => $request->profile,
                'offre_id' => $offre->id,
            ]);

            return redirect()->route('criteres.index')->with('success', 'Critère et offre créés avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $critere = Critere::findOrFail($id);
        if (is_string($critere->formation)) {
            $critere->formation = json_decode($critere->formation, true);
        }
        return view('criteres.edit', ['criteres' => $critere]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'nombre_candidats' => 'required|integer|min:1',
            'date_selection' => 'required|date',
            'date_entretien' => 'required|date',
            'date_test' => 'required|date',
            'local_entretien' => 'required|string',
            'pieces_apporter' => 'required|string',
            'competences_techniques' => 'required|string',
            'competences_linguistiques' => 'required|string',
            'competences_manageriales' => 'required|string',
            'formation' => 'nullable|array',
            'formation.*' => 'string',
            'experience' => 'required|integer|min:0',
            'poids_competence_technique' => 'required|integer|min:0|max:100',
            'poids_competence_linguistique' => 'required|integer|min:0|max:100',
            'poids_competence_manageriale' => 'required|integer|min:0|max:100',
            'poids_formation' => 'required|integer|min:0|max:100',
            'poids_experience' => 'required|integer|min:0|max:100',
            'profile' => 'required|string',
        ]);

        $totalPonderation = 
            $request->poids_competence_technique +
            $request->poids_competence_linguistique +
            $request->poids_competence_manageriale +
            $request->poids_formation +
            $request->poids_experience;

        if ($totalPonderation !== 100) {
            return back()->withInput()->withErrors([
                'ponderation_total' => 'La somme des pondérations doit être exactement 100%. Actuellement : ' . $totalPonderation . '%'
            ]);
        }

        try {
            $critere = Critere::findOrFail($id);
            $offre = Offre::findOrFail($critere->offre_id);

            $critere->update([
                'description' => $request->description,
                'nombre_candidats' => $request->nombre_candidats,
                'date_selection' => $request->date_selection,
                'date_entretien' => $request->date_entretien,
                'date_test' => $request->date_test,
                'local_entretien' => $request->local_entretien,
                'pieces_apporter' => $request->pieces_apporter,
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'formation' => json_encode($request->formation ?? []),
                'experience' => $request->experience,
                'poids_competence_technique' => $request->poids_competence_technique,
                'poids_competence_linguistique' => $request->poids_competence_linguistique,
                'poids_competence_manageriale' => $request->poids_competence_manageriale,
                'poids_formation' => $request->poids_formation,
                'poids_experience' => $request->poids_experience,
                'profile' => $request->profile,
            ]);

            $offre->update([
                'profile' => $request->profile,
                'description' => $request->description,
                'formation' => json_encode($request->formation ?? []),
                'competences_techniques' => $request->competences_techniques,
                'competences_linguistiques' => $request->competences_linguistiques,
                'competences_manageriales' => $request->competences_manageriales,
                'experience' => $request->experience,
                'date_entretien' => $request->date_entretien,
                'date_selection' => $request->date_selection,
            ]);

            return redirect()->route('criteres.index')->with('success', 'Critère et offre mis à jour avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $critere = Critere::findOrFail($id);
            $offre = Offre::find($critere->offre_id);
            $critere->delete();
            if ($offre) {
                $offre->delete();
            }
            return redirect()->route('criteres.index')->with('success', 'Critère et offre supprimés avec succès');
        } catch (Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression du critère');
        }
    }

    public function show($id)
    {
        $critere = Critere::findOrFail($id);
        if (is_string($critere->formation)) {
            $critere->formation = json_decode($critere->formation, true);
        }

        $critere->poids = [
            'competences_techniques' => $critere->poids_competence_technique,
            'competences_linguistiques' => $critere->poids_competence_linguistique,
            'competences_manageriales' => $critere->poids_competence_manageriale,
            'formation' => $critere->poids_formation,
            'experience' => $critere->poids_experience,
        ];

        return view('criteres.show', ['criteres' => $critere]);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Offre;
use App\Models\Candidature;


use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function candidatures($offreId)
    {
        // Récupère l'offre par son ID
        $offre = Offre::findOrFail($offreId);

        // Récupère les candidatures liées à cette offre
        $candidatures = Candidature::where('offre_id', $offreId)->get();

        // Retourne la vue avec les candidatures
        return view('offres.candidatures', compact('offre', 'candidatures'));
    }
    public function index()
    {
        // Récupère toutes les offres disponibles pour le candidat
        $offres = Offre::all();

        // Retourne la vue avec les offres
        return view('offres.index', compact('offres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($offreId) // Accepter l'id dans l'URL
{
    return view('candidats.candidatures.create', compact('offreId'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function candidatures($offreId)
    {
        $offre = Critere::findOrFail($offreId);
        $candidatures = Candidature::where('offre_id', $offreId)->get();

        return view('offres.candidatures', compact('offre', 'candidatures'));
    }

    public function index()
    {
        $offres = Critere::paginate(10);
        $appliedOffreIds = Auth::check() ? Candidature::where('user_id', Auth::id())
            ->pluck('offre_id')
            ->toArray() : [];

        return view('candidats.offres.index', compact('offres', 'appliedOffreIds'));
    }

    public function show($id)
    {
        $offre = Critere::findOrFail($id);
        $hasApplied = Auth::check() && Candidature::where('user_id', Auth::id())
            ->where('offre_id', $offre->id)
            ->exists();

        return view('candidats.offres.show', compact('offre', 'hasApplied'));
    }
}

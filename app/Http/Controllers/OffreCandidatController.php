<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;

class OffreCandidatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'candidat') {
            abort(403, 'Accès réservé aux candidats.');
        }

        $offres = Critere::paginate(10);
        $appliedOffreIds = $user ? Candidature::where('user_id', $user->id)
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

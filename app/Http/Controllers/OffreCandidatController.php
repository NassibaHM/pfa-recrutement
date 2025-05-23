<?php

namespace App\Http\Controllers;

use App\Models\Critere;
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

        return view('candidats.offres.index', compact('offres')); // <- corrigé ici
    }

    public function show($id)
    {
        $offre = Critere::findOrFail($id);

        return view('candidats.offres.show', compact('offre')); // <- corrigé ici
    }
}

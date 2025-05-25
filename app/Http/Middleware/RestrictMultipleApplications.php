<?php

namespace App\Http\Middleware;

use App\Models\Candidature;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictMultipleApplications
{
    public function handle(Request $request, Closure $next)
    {
        $offre_id = $request->route('offreId') ?? $request->route('offre_id') ?? $request->input('offre_id');
        if ($offre_id && Auth::check() && Candidature::where('user_id', Auth::id())
            ->where('offre_id', $offre_id)
            ->exists()) {
            return redirect()->route('candidat.offres')->with('error', 'Vous avez déjà postulé à cette offre.');
        }

        return $next($request);
    }
}

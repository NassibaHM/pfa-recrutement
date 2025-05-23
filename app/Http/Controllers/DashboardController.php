<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        return match ($user->role) {
            'recruteur' => redirect()->route('dashboard'), // ici aussi
            'candidat' => redirect()->route('candidat.welcome'),
            default => abort(403, 'Accès non autorisé')
        };
        
    }
}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    ProfileController,
    CritereController,
    OffreController,
    CandidatureController,
    CandidatController,
    OffreCandidatController
};

// Page d'accueil
Route::get('/', fn() => view('welcome'))->name('welcome');

// Authentification
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Déconnexion forcée
Route::get('/force-logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('force-logout');

// Tableau de bord (redirige selon le rôle)
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'recruteur') {
        return view('dashboard');
    } elseif (Auth::user()->role === 'candidat') {
        return redirect()->route('candidat.welcome');
    }
    abort(403, 'Rôle inconnu.');
})->middleware(['auth'])->name('dashboard');

// Gestion du profil (accessible à tous les rôles connectés)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Debug route to check database
Route::get('/check-database', function () {
    return [
        'has_criteres_table' => \Illuminate\Support\Facades\Schema::hasTable('criteres'),
        'criteres_count' => \App\Models\Critere::count(),
        'criteres_columns' => \Illuminate\Support\Facades\Schema::getColumnListing('criteres'),
        'criteres_data' => \App\Models\Critere::all()->toArray(),
    ];
});

// === Recruteur ===
Route::middleware(['auth', 'role:recruteur'])->group(function () {
    Route::resource('criteres', CritereController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::get('/offres/{id}', [OffreController::class, 'show'])->name('offres.show');
    Route::get('/offres/{id}/candidatures', [CandidatureController::class, 'afficherCandidatures'])->name('offres.candidatures');

    Route::get('/candidats', [CandidatController::class, 'indexRecruteur'])->name('candidats.index');
    Route::get('/candidats/{offreId}', [CandidatController::class, 'indexRecruteur'])->name('candidats.indexByOffre');
    Route::post('/candidats/{candidatureId}/update', [CandidatController::class, 'updateStatus'])->name('candidats.updateStatus');
    Route::post('/candidats/send-response', [CandidatController::class, 'sendResponse'])->name('candidats.sendResponse');
    Route::post('/candidats/notification/{id}/delete', [CandidatController::class, 'deleteNotification'])->name('candidats.deleteNotification');
    Route::get('/candidats/details/{candidatureId}', [CandidatController::class, 'showDetails'])->name('candidats.details');

    Route::get('/notifications/{id}/mark-as-read', [CandidatController::class, 'markAsRead'])->name('notifications.markAsRead');
});

// === Candidat ===
Route::middleware(['auth', 'role:candidat'])->group(function () {
    Route::get('/candidat/welcome', [CandidatController::class, 'index'])->name('candidat.welcome');

    // Liste des offres accessibles au candidat
    Route::get('/candidat/offres', [OffreCandidatController::class, 'index'])->name('candidat.offres');
    Route::get('/candidat/offres/{id}', [OffreCandidatController::class, 'show'])->name('candidat.offres.show');

    // Gestion des candidatures
    Route::get('/candidature/create/{offreId}', [CandidatureController::class, 'create'])
        ->middleware('restrict.applications')->name('candidature.create');
    Route::post('/candidatures', [CandidatureController::class, 'store'])
        ->middleware('restrict.applications')->name('candidature.store');
    Route::get('/candidature/success', [CandidatureController::class, 'success'])->name('candidature.success');
    Route::get('/candidatures/{id}/details', [CandidatureController::class, 'voirDetails'])->name('candidature.voirDetails');

    // Suivi des candidatures
    Route::get('/candidat/postules', [CandidatController::class, 'mesPostes'])->name('candidat.postules');
    Route::get('/candidat/mes-postes', [CandidatController::class, 'mesPostes'])->name('candidat.mes_postes');
    Route::get('/candidat/suivi-candidature', [CandidatController::class, 'suiviCandidature'])->name('candidat.suivi_candidature');

    // Route pour marquer une notification comme lue
    Route::post('/candidats/notifications/mark-as-read/{id}', [CandidatController::class, 'markAsRead'])->name('candidats.markAsRead');
});

// Détail public d'une candidature (restreint aux utilisateurs authentifiés)
Route::get('/candidature/{id}', [CandidatureController::class, 'voirDetails'])
    ->middleware(['auth'])->name('candidature.details');

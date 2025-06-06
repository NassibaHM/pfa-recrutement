<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    ProfileController,
    CritereController,
    OffreController,
    CandidatureController,
    CandidatController,
    OffreCandidatController,
    ResumeAnalyzerController
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
// Tableau de bord (utiliser le contrôleur DashboardController)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/candidat/profile', [CandidatController::class, 'profile'])->name('candidat.profile');
    Route::patch('/candidat/profile', [CandidatController::class, 'updateProfile'])->name('candidat.profile.update');
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
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::get('/offres/{id}', [OffreController::class, 'show'])->name('offres.show');
    Route::get('/offres/{id}/candidatures', [CandidatureController::class, 'afficherCandidatures'])->name('offres.candidatures');
    Route::get('/candidats/{offre_id?}', [CandidatureController::class, 'listCandidats'])->name('candidats.list');
    Route::post('/candidats/{candidatureId}/update', [CandidatController::class, 'updateStatus'])->name('candidats.updateStatus');
    Route::post('/candidats/send-response', [CandidatController::class, 'sendResponse'])->name('candidats.sendResponse');
    Route::post('/candidats/notification/{id}/delete', [CandidatController::class, 'deleteNotification'])->name('candidats.deleteNotification');
    Route::get('/candidats/details/{candidatureId}', [CandidatController::class, 'showDetails'])->name('candidats.details');
    Route::get('/notifications/{id}/mark-as-read', [CandidatController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/candidature/{candidatureId}/analyze', [ResumeAnalyzerController::class, 'analyze'])->name('candidature.analyze');
    Route::post('/critere/{critereId}/rank', [ResumeAnalyzerController::class, 'rank'])->name('critere.rank');
    
    // Critere Routes
    Route::get('/criteres', [CritereController::class, 'index'])->name('criteres.index');
    Route::get('/criteres/create', [CritereController::class, 'create'])->name('criteres.create');
    Route::post('/criteres', [CritereController::class, 'store'])->name('criteres.store');
    Route::get('/criteres/{id}/edit', [CritereController::class, 'edit'])->name('criteres.edit');
    Route::put('/criteres/{id}', [CritereController::class, 'update'])->name('criteres.update');
    Route::delete('/criteres/{id}', [CritereController::class, 'destroy'])->name('criteres.destroy');
    Route::get('/criteres/{id}', [CritereController::class, 'show'])->name('criteres.show');
    
    Route::get('/offres/{offre_id}/candidatures', [CandidatureController::class, 'listCandidatures'])->name('offres.candidatures');
});

// === Candidat ===
Route::middleware(['auth', 'role:candidat'])->group(function () {
    Route::get('/candidat/welcome', [CandidatController::class, 'index'])->name('candidat.welcome');
    Route::post('/candidature/store', [CandidatureController::class, 'store'])->name('candidatures.store');
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
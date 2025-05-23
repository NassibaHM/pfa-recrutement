<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Critere;
use App\Http\Controllers\CritereController;

Route::get('/criteres', function () {
    return response()->json(Critere::all());
});

// Routes avec le contrôleur
Route::post('/criteres', [CritereController::class, 'store']);
Route::put('/criteres/{critere}', [CritereController::class, 'update']);
Route::delete('/criteres/{critere}', [CritereController::class, 'destroy']);

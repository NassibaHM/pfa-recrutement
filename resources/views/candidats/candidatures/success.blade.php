@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-green-100">
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg transform transition-all duration-500 hover:scale-105">
        <!-- Checkmark Icon -->
        <div class="flex justify-center mb-6">
            <svg class="w-16 h-16 text-green-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <!-- Success Message -->
        <h2 class="text-3xl font-bold text-green-600 mb-4 text-center">Candidature Envoyée !</h2>
        <p class="text-gray-600 mb-8 text-center">Votre candidature a été soumise avec succès et sera examinée sous peu.</p>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('candidat.offres') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-300">
                Retour aux Offres
            </a>
            <a href="{{ route('candidat.mes_postes') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-300">
                Mes Candidatures
            </a>
        </div>
    </div>
</div>

<style>
    /* Optional custom animation for the checkmark */
    .animate-pulse {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>
@endsection
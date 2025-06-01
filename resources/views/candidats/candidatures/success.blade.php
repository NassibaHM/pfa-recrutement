@extends('layouts.app')

@section('content')
    <div class="card-modern max-w-md mx-auto p-8 rounded-xl shadow-sm animate-fade-up">
        <!-- Checkmark Icon -->
        <div class="flex justify-center mb-6">
            <i class="fas fa-check-circle text-6xl text-green-500 animate-pulse"></i>
        </div>

        <!-- Success Message -->
        <h2 class="text-2xl font-bold text-[#0f172a] mb-4 text-center">
            <i class="fas fa-check mr-2 text-[#f59e0b]"></i>Candidature envoyée !
        </h2>
        <p class="text-gray-600 mb-8 text-center">Votre candidature a été soumise avec succès et sera examinée sous peu.</p>
        <!-- Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('candidat.offres') }}" 
               class="nav-button bg-[#1e40af] text-white rounded-lg font-medium hover:bg-[#1e3a8a] transition-all">
                Retour aux offres
            </a>
            <a href="{{ route('candidat.mes_postes') }}" 
               class="nav-button bg-[#666] text-white rounded-lg hover:bg-[#333] transition-all">
                Mes candidatures
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .animate-pulse {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
@endpush
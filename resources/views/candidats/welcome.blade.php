@extends('layouts.app')

@section('content')
    <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
        <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
            <i class="fas fa-hand-wave mr-2 text-[#f59e0b]"></i>Bienvenue, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 mb-6">Accédez aux offres, suivez vos candidatures et explorez votre espace personnel.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('candidat.offres') }}" 
               class="card-modern p-4 rounded-lg nav-button bg-[#1e40af] border border-[#1e40af] hover:bg-[#1e3a8a] flex items-center space-x-3">
                <i class="fas fa-file-alt text-xl text-[#f59e0b] icon-vibrant"></i>
                <span class="text-black font-semibold">Voir les offres disponibles</span>
            </a>
            <a href="{{ route('candidat.mes_postes') }}" 
               class="card-modern p-4 rounded-lg nav-button bg-[#1e40af] border border-[#1e40af] hover:bg-[#1e3a8a] flex items-center space-x-3">
                <i class="fas fa-clipboard-list text-xl text-[#1e40af] icon-vibrant"></i>
                <span class="text-black font-semibold">Mes candidatures</span>
            </a>
            <a href="{{ route('candidat.suivi_candidature') }}" 
               class="card-modern p-4 rounded-lg nav-button bg-[#1e40af] border border-[#1e40af] hover:bg-[#1e3a8a] flex items-center space-x-3">
                <i class="fas fa-hourglass-half text-xl text-[#9333ea] icon-vibrant"></i>
                <span class="text-black font-semibold">Suivi de Ma Candidature</span>
            </a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Vibrant Icon Styles */
        .icon-vibrant {
            text-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush
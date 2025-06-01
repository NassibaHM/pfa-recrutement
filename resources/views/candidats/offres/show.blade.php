@extends('layouts.app')

@section('content')
<style>
    /* Ensure @import is at the top */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulseGlow {
        0% {
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
        }
        50% {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.8);
        }
        100% {
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
        }
    }

    .animate-fade-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .pulse-glow {
        animation: pulseGlow 2s infinite;
    }

    .neon-yellow {
        color: #f59e0b;
        text-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
    }

    /* Card Styling */
    .card-modern {
        background: linear-gradient(145deg, rgba(30, 64, 175, 0.2), rgba(255, 255, 255, 0.8));
        border: 1px solid rgba(30, 64, 175, 0.3);
        transition: all 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(30, 64, 175, 0.2);
    }

    /* Skill Card Styling */
    .skill-card {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(30, 64, 175, 0.2);
        transition: all 0.3s ease;
    }

    .skill-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(30, 64, 175, 0.15);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
            <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
                <i class="fas fa-file-alt mr-2 text-[#f59e0b]"></i>{{ $offre->profile }}
            </h1>

            <p class="text-gray-700 mb-6">{{ $offre->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-tools mr-2 text-[#f59e0b]"></i>Compétences Techniques
                    </h2>
                    <p class="text-gray-700">{{ $offre->competences_techniques ?? 'Non spécifié' }}</p>
                </div>
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-language mr-2 text-[#f59e0b]"></i>Compétences Linguistiques
                    </h2>
                    <p class="text-gray-700">{{ $offre->competences_linguistiques ?? 'Non spécifié' }}</p>
                </div>
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-user-tie mr-2 text-[#f59e0b]"></i>Compétences Managériales
                    </h2>
                    <p class="text-gray-700">{{ $offre->competences_manageriales ?? 'Non spécifié' }}</p>
                </div>
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-graduation-cap mr-2 text-[#f59e0b]"></i>Formation
                    </h2>
                    @if(is_array($offre->formation))
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach($offre->formation as $formation)
                                <li>{{ $formation }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-700">{{ $offre->formation ?? 'Non spécifié' }}</p>
                    @endif
                </div>
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-calendar-alt mr-2 text-[#f59e0b]"></i>Dates importantes
                    </h2>
                    <ul class="text-gray-700">
                        <li><strong>Entretien :</strong> {{ $offre->date_entretien ?? 'Non spécifié' }}</li>
                        <li><strong>Test :</strong> {{ $offre->date_test ?? 'Non spécifié' }}</li>
                        <li><strong>Sélection :</strong> {{ $offre->date_selection ?? 'Non spécifié' }}</li>
                    </ul>
                </div>
                <div class="skill-card p-4 rounded">
                    <h2 class="text-lg font-semibold mb-2 text-[#1e40af]">
                        <i class="fas fa-map-marker-alt mr-2 text-[#f59e0b]"></i>Lieu entretien
                    </h2>
                    <p class="text-gray-700">{{ $offre->local_entretien ?? 'Non spécifié' }}</p>
                </div>
            </div>

            <div class="flex justify-between mt-8">
                <a href="{{ route('candidat.offres') }}" 
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition font-medium">
                    ← Retour
                </a>
                @if (Auth::check() && $hasApplied)
                    <span class="bg-gray-400 text-white px-6 py-2 rounded cursor-not-allowed font-medium">Déjà postulé</span>
                @else
                    <a href="{{ route('candidature.create', $offre->id) }}" 
                       class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition font-medium">
                        Postuler
                    </a>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- Font Awesome 6.6.0 (move to layouts.app if not already included) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

@endsection

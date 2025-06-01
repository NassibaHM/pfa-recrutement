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

    @keyframes slideRight {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-fade-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-slide-right {
        animation: slideRight 0.5s ease-out;
    }

    .pulse-glow {
        animation: pulseGlow 2s infinite;
    }

    .neon-yellow {
        color: #f59e0b;
        text-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
    }

    /* Sidebar Styling */
    .sidebar-modern {
        background: linear-gradient(180deg, #1e40af 0%, #4b5e99 100%);
        color: #ffffff;
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

    /* Table Styling */
    .table-modern th {
        background: #1e40af;
        color: #ffffff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .table-modern tr:nth-child(even) {
        background: rgba(30, 64, 175, 0.05);
    }

    .table-modern tr:hover {
        background: rgba(245, 158, 11, 0.1);
    }

    .table-modern td, .table-modern th {
        border: 1px solid rgba(30, 64, 175, 0.2);
        padding: 12px;
        font-size: 0.875rem;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16">
                <!-- Espacement auto à gauche -->
                <div class="ml-auto flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        Bienvenue, <strong>{{ Auth::user()->name }}</strong>
                    </span>
                    <div class="w-8 h-8 bg-gradient-to-r from-[#1e40af] to-[#0f172a] rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 min-h-screen sidebar-modern animate-slide-right">
            <div class="p-8">
                <!-- Logo Section -->
                <div class="mb-12">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center pulse-glow">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Recruit<span class="neon-yellow">AI</span></h1>
                            <p class="text-gray-200 text-sm">Intelligence Artificielle</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Futuriste -->
                <nav class="space-y-3">
                    <div class="text-gray-200 text-xs font-semibold uppercase tracking-wider mb-6">Menu Principal</div>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-home text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Dashboard</div>
                            <div class="text-xs text-gray-200">Vue d'ensemble</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ route('criteres.index') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-20 border border-white border-opacity-30 text-white transition-all hover:bg-opacity-30 hover:border-opacity-50">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Offres</div>
                            <div class="text-xs text-gray-200">Gestion des profils</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    
                    <a href="{{ route('candidats.list') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Candidats</div>
                            <div class="text-xs text-gray-200">Base de données RH</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>

                    <a href="{{ route('logout') }}" 
                       class="group flex items-center p-4 rounded-xl bg-red-900/30 hover:bg-red-900/50 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Déconnexion</div>
                            <div class="text-xs text-gray-200">Se déconnecter</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-[#0f172a]">Détails des Critères du Poste</h2>
                    <a href="{{ route('criteres.index') }}" 
                       class="nav-button px-4 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a]">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>

                <!-- Tableau des Critères -->
                <div class="overflow-x-auto">
                    <table class="w-full table-modern">
                        <thead>
                            <tr>
                                <th>Critère</th>
                                <th>Détail</th>
                                <th>Poids (sur 100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $poids = $criteres->poids ?? [];
                                $rows = [
                                    ['label' => 'Nom du Profil', 'value' => $criteres->profile ?? 'Non spécifié', 'key' => 'profile'],
                                    ['label' => 'Description du Poste', 'value' => $criteres->description ?? 'Non spécifié', 'key' => 'description'],
                                    ['label' => 'Nombre de Postes', 'value' => $criteres->nombre_candidats ?? 'Non spécifié', 'key' => 'nombre_candidats'],
                                    ['label' => 'Date de Sélection', 'value' => $criteres->date_selection ?? 'Non spécifié', 'key' => 'date_selection'],
                                    ['label' => 'Date de l\'Entretien', 'value' => $criteres->date_entretien ?? 'Non spécifié', 'key' => 'date_entretien'],
                                    ['label' => 'Date du Test', 'value' => $criteres->date_test ?? 'Non spécifié', 'key' => 'date_test'],
                                    ['label' => 'Lieu de l\'Entretien', 'value' => $criteres->local_entretien ?? 'Non spécifié', 'key' => 'local_entretien'],
                                    ['label' => 'Pièces à Fournir', 'value' => $criteres->pieces_apporter ?? 'Non spécifié', 'key' => 'pieces_apporter'],
                                    ['label' => 'Compétences Techniques', 'value' => $criteres->competences_techniques ?? 'Non spécifié', 'key' => 'competences_techniques'],
                                    ['label' => 'Compétences Linguistiques', 'value' => $criteres->competences_linguistiques ?? 'Non spécifié', 'key' => 'competences_linguistiques'],
                                    ['label' => 'Compétences Managériales', 'value' => $criteres->competences_manageriales ?? 'Non spécifié', 'key' => 'competences_manageriales'],
                                    ['label' => 'Expérience (en années)', 'value' => $criteres->experience ?? 'Non spécifié', 'key' => 'experience'],
                                ];
                            @endphp

                            @foreach ($rows as $row)
                                <tr>
                                    <td class="font-semibold text-[#0f172a]">{{ $row['label'] }}</td>
                                    <td>{{ $row['value'] }}</td>
                                    <td>{{ $poids[$row['key']] ?? 'N/A' }}</td>
                                </tr>
                            @endforeach

                            <!-- Formation -->
                            <tr>
                                <td class="font-semibold text-[#0f172a]">Formation</td>
                                <td>
                                    @if (!empty($criteres->formation))
                                        @php
                                            $formations = is_string($criteres->formation) ? json_decode($criteres->formation, true) : (is_array($criteres->formation) ? $criteres->formation : []);
                                        @endphp
                                        @foreach ($formations as $formation)
                                            {{ trim($formation) }}@if (!$loop->last), @endif
                                        @endforeach
                                    @else
                                        Aucune formation spécifiée.
                                    @endif
                                </td>
                                <td>{{ $poids['formation'] ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
</div>
@endsection
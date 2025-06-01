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

    /* Button Styling */
    .nav-button {
        transition: all 0.3s ease;
    }

    .nav-button:hover {
        background-color: rgba(245, 158, 11, 0.3) !important;
        transform: scale(1.02);
    }

    .nav-button.active {
        background-color: rgba(245, 158, 11, 0.5) !important;
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

    /* Input Styling */
    .input-modern {
        border: 1px solid rgba(30, 64, 175, 0.3);
        background: #ffffff;
        transition: all 0.3s ease;
    }

    .input-modern:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        outline: none;
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
                <h3 class="text-2xl font-bold text-[#0f172a] mb-6">Liste des Profils</h3>

                <!-- Search and Add Profile -->
                <div class="flex justify-between items-center mb-6">
                    <form method="GET" action="{{ route('criteres.index') }}" class="flex space-x-4">
                        <input type="text" name="search_profile" placeholder="Recherche par Profile" 
                               class="input-modern px-4 py-2 rounded-lg text-[#0f172a] w-64" 
                               value="{{ request('search_profile') }}">
                        <button type="submit" 
                                class="nav-button px-4 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a]">
                            <i class="fas fa-search mr-2"></i>Rechercher
                        </button>
                    </form>
                    <a href="{{ route('criteres.create') }}" 
                       class="nav-button px-4 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a]">
                        <i class="fas fa-plus mr-2"></i>Ajouter un Profil
                    </a>
                </div>

                @if ($criteres->isEmpty())
                    <p class="text-gray-500 text-sm">Aucun profil trouvé.</p>
                @else
                    <div class="overflow-x-auto max-h-[600px]">
                        <table class="w-full table-modern">
                            <thead>
                                <tr>
                                    <th>Profil</th>
                                    <th>Description</th>
                                    <th>Date Sélection</th>
                                    <th>Date Entretien</th>
                                    <th>Date Test</th>
                                    <th>Lieu Entretien</th>
                                    <th>Nombre Candidats</th>
                                    <th>Compétences</th>
                                    <th>Actions</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteres as $critere)
                                    <tr>
                                        <td>{{ $critere->profile }}</td>
                                        <td>{{ Str::limit($critere->description, 50) }}</td>
                                        <td>{{ $critere->date_selection }}</td>
                                        <td>{{ $critere->date_entretien }}</td>
                                        <td>{{ $critere->date_test }}</td>
                                        <td>{{ $critere->local_entretien }}</td>
                                        <td>{{ $critere->nombre_candidats }}</td>
                                        <td>
                                            <ul class="list-inside space-y-1 text-sm">
                                                <li><span class="font-medium text-[#1e40af]">Techniques:</span> {{ $critere->competences_techniques }}</li>
                                                <li><span class="font-medium text-[#1e40af]">Linguistiques:</span> {{ $critere->competences_linguistiques }}</li>
                                                <li><span class="font-medium text-[#1e40af]">Managériales:</span> {{ $critere->competences_manageriales }}</li>
                                            </ul>
                                        </td>
                                        <td class="flex justify-start space-x-4">
                                            <a href="{{ route('criteres.edit', $critere->id) }}" 
                                               class="text-[#1e40af] hover:underline">
                                                <i class="fas fa-edit mr-1"></i>Modifier
                                            </a>
                                            <form action="{{ route('criteres.destroy', $critere->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:underline" 
                                                        onclick="return confirm('Êtes-vous sûr de supprimer ce profil ?')">
                                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('criteres.show', $critere->id) }}" 
                                               class="nav-button px-4 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a] w-full text-center block border border-[#1e40af]">
                                                <i class="fas fa-eye mr-2"></i>Voir Détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $criteres->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
</div>
@endsection
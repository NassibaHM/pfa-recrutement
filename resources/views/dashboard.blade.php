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

    /* Chart Container */
    .chart-container {
        background: #ffffff;
        border: 1px solid rgba(30, 64, 175, 0.1);
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 100%;
        height: 400px;
        position: relative;
        box-sizing: border-box;
    }

    .chart-container canvas {
        width: 100% !important;
        height: 100% !important;
        max-width: 100%;
        max-height: 100%;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
  

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
            <!-- Welcome Section -->
            <div class="mb-8 animate-fade-up flex items-center justify-between">
                <!-- Titre à gauche -->
                <div>
                    <h2 class="text-2xl font-bold text-[#0f172a] mb-2">Tableau de bord</h2>
                    <p class="text-gray-600">Gérez vos offres et suivez vos candidatures en temps réel</p>
                </div>
            
                <!-- Utilisateur à droite -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Bienvenue, <strong>{{ Auth::user()->name }}</strong></span>
                    <div class="w-8 h-8 bg-gradient-to-r from-[#1e40af] to-[#0f172a] rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
            

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12 animate-fade-up">
                <!-- Offres Actives -->
                <div class="card-modern rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#1e40af]/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#1e40af]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Offres Actives</p>
                            <p class="text-2xl font-bold text-[#0f172a]">{{ \App\Models\Offre::where('statut', 'active')->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-[#f59e0b] font-medium">Total Offres: {{ \App\Models\Offre::count() }}</span>
                        <a href="{{ route('criteres.index') }}" class="block text-sm text-[#f59e0b] font-medium hover:underline mt-1">Voir toutes les offres</a>
                    </div>
                </div>

                <!-- Total Candidatures -->
                <div class="card-modern rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#1e40af]/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#1e40af]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Candidatures</p>
                            <p class="text-2xl font-bold text-[#0f172a]">{{ \App\Models\Candidature::count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-[#f59e0b] font-medium">En attente: {{ \App\Models\Candidature::where('etat', 'en attente')->count() }}</span>
                        <a href="{{ route('candidats.list') }}" class="block text-sm text-[#f59e0b] font-medium hover:underline mt-1">Voir toutes les candidatures</a>
                    </div>
                </div>

                <!-- Entretiens Planifiés -->
                <div class="card-modern rounded-xl shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#1e40af]/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#1e40af]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Entretiens Planifiés</p>
                            <p class="text-2xl font-bold text-[#0f172a]">{{ \App\Models\Candidature::where('etat', 'entretien RH')->count() }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-[#f59e0b] font-medium">Tests techniques: {{ \App\Models\Candidature::where('etat', 'test technique')->count() }}</span>
                        <a href="{{ route('criteres.create') }}" class="block text-sm text-[#f59e0b] font-medium hover:underline mt-1">Ajouter un critère</a>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-container mb-6 animate-fade-up">
                <h2 class="text-xl font-bold text-[#0f172a] mb-4">Candidatures vs Offres</h2>
                @php
                    $offresActives = \App\Models\Offre::where('statut', 'active')->count();
                    $totalCandidatures = \App\Models\Candidature::count();
                @endphp
                @if ($offresActives == 0 && $totalCandidatures == 0)
                    <p class="text-gray-500 text-sm">Aucune donnée disponible pour le graphique.</p>
                @else
                    <canvas id="candidaturesChart"></canvas>
                @endif
            </div>
        </main>
    </div>

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Chart.js 4.4.2 UMD -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('candidaturesChart');
            if (!ctx) {
                console.error('Canvas element #candidaturesChart not found.');
                return;
            }
            if (typeof Chart === 'undefined') {
                console.error('Chart.js failed to load. Please check the CDN or network connection.');
                return;
            }

            // Adjust canvas resolution for high-DPI displays
            const pixelRatio = window.devicePixelRatio || 1;
            ctx.width = ctx.offsetWidth * pixelRatio;
            ctx.height = ctx.offsetHeight * pixelRatio;
            ctx.getContext('2d').scale(pixelRatio, pixelRatio);

            new Chart(ctx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Offres Actives', 'Candidatures'],
                    datasets: [{
                        label: 'Nombre',
                        data: [{{ \App\Models\Offre::where('statut', 'active')->count() }}, {{ \App\Models\Candidature::count() }}],
                        backgroundColor: ['#1e40af', '#f59e0b'],
                        borderColor: ['#0f172a', '#0f172a'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    devicePixelRatio: pixelRatio, // Match device resolution
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre',
                                color: '#0f172a',
                                font: { size: 12 }
                            },
                            ticks: { 
                                color: '#0f172a', 
                                font: { size: 12 } 
                            },
                            grid: { 
                                color: 'rgba(15, 23, 42, 0.2)' 
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Catégorie',
                                color: '#0f172a',
                                font: { size: 12 }
                            },
                            ticks: { 
                                color: '#0f172a', 
                                font: { size: 12 } 
                            },
                            grid: { 
                                display: false 
                            }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: false // No legend
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 }
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection
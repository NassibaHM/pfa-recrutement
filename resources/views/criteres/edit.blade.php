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

    /* Checkbox Styling */
    .checkbox-modern {
        accent-color: #1e40af;
        width: 1rem;
        height: 1rem;
        margin-right: 0.5rem;
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
                <h2 class="text-2xl font-bold text-[#0f172a] mb-6">Modifier les Critères du Poste</h2>

                <form action="{{ route('criteres.update', $criteres->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Profil -->
                    <div class="mb-6">
                        <label for="profile" class="block font-semibold text-[#0f172a] mb-2">Profil</label>
                        <input id="profile" type="text" name="profile" 
                               value="{{ old('profile', $criteres->profile) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('profile') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Description du Poste -->
                    <div class="mb-6">
                        <label for="description" class="block font-semibold text-[#0f172a] mb-2">Description du Poste</label>
                        <textarea id="description" name="description" rows="4" 
                                  required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">{{ old('description', $criteres->description) }}</textarea>
                        @error('description') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Nombre de Candidats -->
                    <div class="mb-6">
                        <label for="nombre_candidats" class="block font-semibold text-[#0f172a] mb-2">Nombre de Postes</label>
                        <input id="nombre_candidats" type="number" name="nombre_candidats" min="1" 
                               value="{{ old('nombre_candidats', $criteres->nombre_candidats) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('nombre_candidats') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Dates et Lieu -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="date_selection" class="block font-semibold text-[#0f172a] mb-2">Date de Sélection</label>
                            <input id="date_selection" type="date" name="date_selection" 
                                   value="{{ old('date_selection', $criteres->date_selection) }}" 
                                   required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            @error('date_selection') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div>
                            <label for="date_entretien" class="block font-semibold text-[#0f172a] mb-2">Date d'Entretien</label>
                            <input id="date_entretien" type="date" name="date_entretien" 
                                   value="{{ old('date_entretien', $criteres->date_entretien) }}" 
                                   required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            @error('date_entretien') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div>
                            <label for="date_test" class="block font-semibold text-[#0f172a] mb-2">Date du Test</label>
                            <input id="date_test" type="date" name="date_test" 
                                   value="{{ old('date_test', $criteres->date_test) }}" 
                                   required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            @error('date_test') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div>
                            <label for="local_entretien" class="block font-semibold text-[#0f172a] mb-2">Lieu d'Entretien</label>
                            <input id="local_entretien" type="text" name="local_entretien" 
                                   value="{{ old('local_entretien', $criteres->local_entretien) }}" 
                                   required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            @error('local_entretien') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>

                    <!-- Pièces à Fournir -->
                    <div class="mb-6">
                        <label for="pieces_apporter" class="block font-semibold text-[#0f172a] mb-2">Pièces à Fournir</label>
                        <input id="pieces_apporter" type="text" name="pieces_apporter" 
                               value="{{ old('pieces_apporter', $criteres->pieces_apporter) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('pieces_apporter') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Compétences -->
                    <div class="mb-6">
                        <label class="block font-semibold text-[#0f172a] mb-4">Compétences</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <input type="text" name="competences_techniques" 
                                       placeholder="Compétences Techniques" 
                                       value="{{ old('competences_techniques', $criteres->competences_techniques) }}" 
                                       required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a] mb-3">
                                <input type="number" name="poids_competence_technique" 
                                       min="0" max="100" 
                                       value="{{ old('poids_competence_technique', $criteres->poids_competence_technique) }}" 
                                       required placeholder="Poids (%)" 
                                       class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            </div>
                            <div>
                                <input type="text" name="competences_linguistiques" 
                                       placeholder="Compétences Linguistiques" 
                                       value="{{ old('competences_linguistiques', $criteres->competences_linguistiques) }}" 
                                       required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a] mb-3">
                                <input type="number" name="poids_competence_linguistique" 
                                       min="0" max="100" 
                                       value="{{ old('poids_competence_linguistique', $criteres->poids_competence_linguistique) }}" 
                                       required placeholder="Poids (%)" 
                                       class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            </div>
                            <div>
                                <input type="text" name="competences_manageriales" 
                                       placeholder="Compétences Managériales" 
                                       value="{{ old('competences_manageriales', $criteres->competences_manageriales) }}" 
                                       required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a] mb-3">
                                <input type="number" name="poids_competence_manageriale" 
                                       min="0" max="100" 
                                       value="{{ old('poids_competence_manageriale', $criteres->poids_competence_manageriale) }}" 
                                       required placeholder="Poids (%)" 
                                       class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                            </div>
                        </div>
                    </div>

                    <!-- Formation -->
                    <div class="mb-6">
                        <label class="block font-semibold text-[#0f172a] mb-4">Formation Requise</label>
                        @php
                            $formations = ['BTS/DUT', 'Licence', 'Master', 'Ingénieur', 'Doctorat'];
                            $checkedFormations = is_string($criteres->formation) ? json_decode($criteres->formation, true) : ($criteres->formation ?? []);
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            @foreach ($formations as $formation)
                                <div class="flex items-center">
                                    <input type="checkbox" name="formation[]" 
                                           id="formation_{{ $formation }}" 
                                           value="{{ $formation }}" 
                                           class="checkbox-modern"
                                           {{ is_array(old('formation', $checkedFormations)) && in_array($formation, old('formation', $checkedFormations)) ? 'checked' : '' }}>
                                    <label for="formation_{{ $formation }}" class="text-[#0f172a] text-sm">{{ $formation }}</label>
                                </div>
                            @endforeach
                        </div>
                        <label for="poids_formation" class="block font-semibold text-[#0f172a] mb-2">Pondération Formation (%)</label>
                        <input id="poids_formation" type="number" name="poids_formation" 
                               min="0" max="100" 
                               value="{{ old('poids_formation', $criteres->poids_formation) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('poids_formation') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Expérience -->
                    <div class="mb-6">
                        <label for="experience" class="block font-semibold text-[#0f172a] mb-2">Expérience (en années)</label>
                        <input id="experience" type="number" name="experience" 
                               min="0" 
                               value="{{ old('experience', $criteres->experience) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('experience') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror

                        <label for="poids_experience" class="block font-semibold text-[#0f172a] mt-4 mb-2">Pondération Expérience (%)</label>
                        <input id="poids_experience" type="number" name="poids_experience" 
                               min="0" max="100" 
                               value="{{ old('poids_experience', $criteres->poids_experience) }}" 
                               required class="input-modern w-full px-4 py-2 rounded-lg text-[#0f172a]">
                        @error('poids_experience') 
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                        @enderror
                    </div>

                    <!-- Pondération Totale -->
                    <div class="mb-6">
                        <p class="text-sm text-gray-500">Somme des Pondérations : <span id="somme-ponderation">0 %</span></p>
                        <p id="message-erreur" class="text-red-600 text-sm mt-1"></p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="btn-submit" 
                            class="nav-button px-6 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a] disabled:bg-gray-400 disabled:cursor-not-allowed">
                        <i class="fas fa-save mr-2"></i>Modifier
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- jQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            function calculerPonderation() {
                let total = 0;
                const champs = [
                    'input[name="poids_formation"]',
                    'input[name="poids_experience"]',
                    'input[name="poids_competence_technique"]',
                    'input[name="poids_competence_linguistique"]',
                    'input[name="poids_competence_manageriale"]'
                ];
                champs.forEach(selector => {
                    total += parseInt($(selector).val()) || 0;
                });
                $('#somme-ponderation').text(`${total} %`);
                if (total !== 100) {
                    $('#message-erreur').text('⚠️ La somme des pondérations doit être exactement 100 %.');
                    $('#btn-submit').prop('disabled', true);
                } else {
                    $('#message-erreur').text('');
                    $('#btn-submit').prop('disabled', false);
                }
            }

            $('input[type="number"]').on('input', calculerPonderation);
            calculerPonderation();
        });
    </script>
</div>
@endsection
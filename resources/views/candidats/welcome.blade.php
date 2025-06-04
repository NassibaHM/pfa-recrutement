@extends('layouts.app')

@section('content')
    <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
        <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
            <i class="fas fa-hand-wave mr-2 text-[#f59e0b]"></i>Bienvenue, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 mb-6">Accédez aux offres, suivez vos candidatures et explorez votre espace personnel.</p>


<!-- Cards Section -->
<!-- Cards Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Offres disponibles -->
    <a href="{{ route('candidat.offres') }}" 
       class="card-modern p-4 rounded-lg nav-button bg-white border border-[#1e40af] hover:bg-gray-100 flex items-center space-x-3">
        <i class="fas fa-file-alt text-xl text-[#f59e0b] icon-vibrant"></i>
        <div class="flex-1">
            <span class="text-white font-semibold">Offres disponibles</span>
            <p class="text-sm mt-1">
                @php
                    $availableOffers = \App\Models\Offre::where('statut', 'active')->count();
                @endphp
                <span class="text-[#1e40af] font-semibold">
                    {{ $availableOffers }} offre(s) disponible(s)
                </span>
            </p>
        </div>
    </a>

    <!-- Mes candidatures -->
    <a href="{{ route('candidat.mes_postes') }}" 
       class="card-modern p-4 rounded-lg nav-button bg-white border border-[#1e40af] hover:bg-gray-100 flex items-center space-x-3">
        <i class="fas fa-clipboard-list text-xl text-[#f59e0b] icon-vibrant"></i>
        <div class="flex-1">
            <span class="text-white font-semibold">Mes candidatures</span>
            <p class="text-sm mt-1">
                @php
                    $userCandidatures = \App\Models\Candidature::where('user_id', Auth::id())->count();
                @endphp
                <span class="text-[#1e40af] font-semibold">
                    {{ $userCandidatures }} candidature(s) soumise(s)
                </span>
            </p>
        </div>
    </a>
</div>



        <!-- Chart and Info Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Bar Chart -->
            <div class="card-modern p-6 rounded-lg">
                <h2 class="text-lg font-semibold text-[#0f172a] mb-4">Statistiques</h2>
                <div class="relative w-full h-64">
                    <canvas id="offersVsCandidaturesChart" class="absolute inset-0"></canvas>
                </div>
            </div>

            <!-- Info Section -->
            <div class="card-modern p-6 rounded-lg flex flex-col space-y-4">
                <h2 class="text-lg font-semibold text-[#0f172a] mb-4">À propos de l'application</h2>
                <p class="text-gray-600 text-sm">
                    Bienvenue sur <span class="font-bold text-[#f59e0b]">RecruitAI</span>, votre plateforme intelligente pour trouver des opportunités d'emploi et gérer vos candidatures efficacement.
                </p>
                <div class="text-gray-600 text-sm">
                    <h3 class="font-semibold text-[#0f172a] mb-2">Comment postuler ?</h3>
                    <p>Naviguez vers la section "Offres", sélectionnez une offre qui vous intéresse, et remplissez le formulaire de candidature avec vos informations.</p>
                </div>
                <div class="text-gray-600 text-sm">
                    <h3 class="font-semibold text-[#0f172a] mb-2">Suivre vos candidatures</h3>
                    <p>Consultez la section "Suivi Candidature" pour voir l'état de vos candidatures et recevoir des notifications sur les prochaines étapes.</p>
                </div>
                <div class="text-gray-600 text-sm">
                    <h3 class="font-semibold text-[#0f172a] mb-2">Actions rapides</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('candidat.mes_postes') }}" class="text-[#1e40af] hover:underline">Voir mes candidatures</a>
                        </li>
                        <li>
                            <a href="{{ route('candidat.profile') }}" class="text-[#1e40af] hover:underline">Voir et modifier mon profil</a>
                        </li>
                    </ul>
                </div>
            </div>
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

@push('scripts')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        let chartInstance = null;

        function initializeChart() {
            const ctx = document.getElementById('offersVsCandidaturesChart');
            if (!ctx) return;

            const context = ctx.getContext('2d');

            if (chartInstance) {
                chartInstance.destroy();
            }

            chartInstance = new Chart(context, {
                type: 'bar',
                data: {
                    labels: ['Offres disponibles', 'Candidatures soumises'],
                    datasets: [{
                        label: 'Nombre',
                        data: [{{ $availableOffers }}, {{ $userCandidatures }}],
                        backgroundColor: ['#1e40af', '#f59e0b'],
                        borderColor: ['#1e3a8a', '#d97706'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Catégorie'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Offres vs Candidatures'
                        }
                    }
                }
            });

            console.log('Chart initialized');
        }

        document.addEventListener('DOMContentLoaded', initializeChart);

        let resizeTimeout;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (chartInstance) {
                    chartInstance.resize();
                    console.log('Chart resized');
                }
            }, 200);
        });
    </script>
@endpush
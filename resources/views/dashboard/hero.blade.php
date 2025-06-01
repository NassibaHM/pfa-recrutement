<section class="hero-bg relative overflow-hidden">
    <div class="hero-pattern absolute inset-0"></div>
    
    <!-- Background decorative elements -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-500 rounded-full opacity-20 animate-float"></div>
    <div class="absolute bottom-10 right-10 w-24 h-24 bg-amber-500 rounded-full opacity-20 animate-float" style="animation-delay: -2s;"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Welcome Content -->
            <div class="animate-slide-left">
                <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                    Tableau de Bord
                    <span class="gradient-text-accent block">Intelligence</span>
                </h1>
                <p class="text-xl text-gray-300 mb-6 leading-relaxed">
                    Optimisez votre processus de recrutement avec des insights en temps réel 
                    et des outils d'intelligence artificielle avancés.
                </p>
                <div class="flex items-center space-x-6 text-gray-400">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['offres_actives'] ?? 0 }}</div>
                        <div class="text-sm">Offres Actives</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $stats['total_candidatures'] ?? 0 }}</div>
                        <div class="text-sm">Candidatures</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ number_format($stats['taux_reussite'] ?? 0, 1) }}%</div>
                        <div class="text-sm">Taux Réussite</div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="animate-slide-right">
                <div class="glass-morphism rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-bolt text-blue-600 mr-3"></i>
                        Actions Rapides
                    </h3>
                    <div class="space-y-4">
                        <a href="{{ route('criteres.create') }}" class="btn-primary w-full flex items-center justify-center space-x-2 text-decoration-none">
                            <i class="fas fa-plus"></i>
                            <span>Nouvelle Offre d'Emploi</span>
                        </a>
                        <button class="btn-accent w-full flex items-center justify-center space-x-2">
                            <i class="fas fa-chart-line"></i>
                            <span>Analyser les Candidatures</span>
                        </button>
                        <button class="glass-morphism w-full p-3 rounded-xl font-semibold text-gray-700 hover:bg-white transition-all">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Planifier un Entretien
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
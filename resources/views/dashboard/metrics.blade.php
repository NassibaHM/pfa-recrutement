<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16 animate-fade-up">
            <!-- Métrique 1 - Offres Actives -->
            <div class="modern-card rounded-2xl p-8 group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Offres Actives</h3>
                        <div class="text-3xl font-bold gradient-text mb-2">{{ $stats['offres_actives'] ?? 0 }}</div>
                        <div class="flex items-center text-green-600 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i>
                            {{ $stats['evolution_offres'] ?? '+12%' }} ce mois
                        </div>
                    </div>
                    <div class="circle-progress">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                            <circle cx="40" cy="40" r="35" stroke="#3b82f6" stroke-width="4" fill="none" 
                                    stroke-dasharray="{{ 2 * 3.14 * 35 }}" 
                                    stroke-dashoffset="{{ (1 - ($stats['offres_actives'] ?? 0) / 50) * 2 * 3.14 * 35 }}" 
                                    class="progress-ring"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Métrique 2 - Candidatures -->
            <div class="modern-card rounded-2xl p-8 group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Candidatures</h3>
                        <div class="text-3xl font-bold gradient-text mb-2">{{ $stats['total_candidatures'] ?? 0 }}</div>
                        <div class="flex items-center text-green-600 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i>
                            {{ $stats['evolution_candidatures'] ?? '+25%' }} ce mois
                        </div>
                    </div>
                    <div class="circle-progress">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                            <circle cx="40" cy="40" r="35" stroke="#10b981" stroke-width="4" fill="none" 
                                    stroke-dasharray="{{ 2 * 3.14 * 35 }}" 
                                    stroke-dashoffset="{{ (1 - ($stats['total_candidatures'] ?? 0) / 500) * 2 * 3.14 * 35 }}" 
                                    class="progress-ring"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Métrique 3 - Entretiens -->
            <div class="modern-card rounded-2xl p-8 group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calendar-alt text-2xl text-purple-600"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Entretiens</h3>
                        <div class="text-3xl font-bold gradient-text mb-2">{{ $stats['entretiens_planifies'] ?? 0 }}</div>
                        <div class="flex items-center text-purple-600 text-sm font-medium">
                            <i class="fas fa-clock mr-1"></i>
                            Cette semaine
                        </div>
                    </div>
                    <div class="circle-progress">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                            <circle cx="40" cy="40" r="35" stroke="#8b5cf6" stroke-width="4" fill="none" 
                                    stroke-dasharray="{{ 2 * 3.14 * 35 }}" 
                                    stroke-dashoffset="{{ (1 - ($stats['entretiens_planifies'] ?? 0) / 20) * 2 * 3.14 * 35 }}" 
                                    class="progress-ring"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Métrique 4 - Taux Réussite -->
            <div class="modern-card rounded-2xl p-8 group">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="w-16 h-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-trophy text-2xl text-orange-600"></i>
                        </div>
                        <h3 class="text-sm font-medium text-gray-600 mb-2">Taux de Réussite</h3>
                        <div class="text-3xl font-bold gradient-text-accent mb-2">{{ number_format($stats['taux_reussite'] ?? 0, 1) }}%</div>
                        <div class="flex items-center text-orange-600 text-sm font-medium">
                            <i class="fas fa-star mr-1"></i>
                            @if(($stats['taux_reussite'] ?? 0) >= 80)
                                Excellent
                            @elseif(($stats['taux_reussite'] ?? 0) >= 60)
                                Bon
                            @else
                                À améliorer
                            @endif
                        </div>
                    </div>
                    <div class="circle-progress">
                        <svg width="80" height="80">
                            <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="4" fill="none"/>
                            <circle cx="40" cy="40" r="35" stroke="#f59e0b" stroke-width="4" fill="none" 
                                    stroke-dasharray="{{ 2 * 3.14 * 35 }}" 
                                    stroke-dashoffset="{{ (1 - ($stats['taux_reussite'] ?? 0) / 100) * 2 * 3.14 * 35 }}" 
                                    class="progress-ring"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8 animate-fade-up">
            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <div class="modern-card rounded-2xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-activity text-blue-600 mr-3"></i>
                            Activité Récente
                        </h3>
                        <div class="flex items-center space-x-2 bg-green-100 rounded-full px-3 py-1">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-green-700 text-sm font-medium">En direct</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @forelse($activites_recentes ?? [] as $activite)
                            <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 transition-colors">
                                <div class="w-3 h-3 bg-{{ $activite['couleur'] ?? 'blue' }}-400 rounded-full mt-2 mr-4 flex-shrink-0 animate-pulse"></div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">{{ $activite['titre'] }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ $activite['description'] }}</p>
                                </div>
                                <div class="text-blue-600 text-sm font-medium">{{ $activite['temps'] ?? 'maintenant' }}</div>
                            </div>
                        @empty
                            <div class="flex items-start p-4 bg-blue-50 rounded-xl border border-blue-100">
                                <div class="w-3 h-3 bg-blue-400 rounded-full mt-2 mr-4 flex-shrink-0 animate-pulse"></div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">Bienvenue sur RecruitAI</p>
                                    <p class="text-gray-600 text-sm mt-1">Commencez par créer votre première offre d'emploi pour voir l'activité ici</p>
                                </div>
                                <div class="text-blue-600 text-sm font-medium">maintenant</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div>
                <div class="modern-card rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-compass text-blue-600 mr-3"></i>
                        Navigation
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('criteres.index') }}" 
                           class="group flex items-center p-4 rounded-xl bg-gray-50 hover:bg-blue-50 transition-all border border-gray-100 hover:border-blue-200 text-decoration-none">
                            <div class="w-10 h-10 bg-blue-100 group-hover:bg-blue-200 rounded-lg flex items-center justify-center mr-4 transition-colors">
                                <i class="fas fa-briefcase text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">Offres d'Emploi</div>
                                <div class="text-sm text-gray-600">Gérer vos postes</div>
                            </div>
                            <i class="fas fa-chevron-right text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>
                        
                        <a href="{{ route('candidats.list') }}" 
                           class="group flex items-center p-4 rounded-xl bg-gray-50 hover:bg-green-50 transition-all border border-gray-100 hover:border-green-200 text-decoration-none">
                            <div class="w-10 h-10 bg-green-100 group-hover:bg-green-200 rounded-lg flex items-center justify-center mr-4 transition-colors">
                                <i class="fas fa-users text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">Candidats</div>
                                <div class="text-sm text-gray-600">Base de données RH</div>
                            </div>
                            <i class="fas fa-chevron-right text-green-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </a>

                        <div class="group flex items-center p-4 rounded-xl bg-gray-50 hover:bg-purple-50 transition-all border border-gray-100 hover:border-purple-200 cursor-pointer">
                            <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-lg flex items-center justify-center mr-4 transition-colors">
                                <i class="fas fa-chart-line text-purple-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">Analytics</div>
                                <div class="text-sm text-gray-600">Rapports détaillés</div>
                            </div>
                            <i class="fas fa-chevron-right text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
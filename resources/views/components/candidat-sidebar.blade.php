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

        <!-- Navigation -->
        <nav class="space-y-3">
            <div class="text-gray-200 text-xs font-semibold uppercase tracking-wider mb-6">Menu Candidat</div>
            <a href="{{ route('candidat.welcome') }}" 
               class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.welcome') ? 'active' : '' }}">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-home text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">Accueil</div>
                    <div class="text-xs text-gray-200">Vue d'ensemble</div>
                </div>
                <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <a href="{{ route('candidat.offres') }}" 
               class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.offres') || Route::is('candidat.offres.show') ? 'active' : '' }}">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-search text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">Offres</div>
                    <div class="text-xs text-gray-200">Explorer les opportunités</div>
                </div>
                <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <a href="{{ route('candidat.mes_postes') }}" 
               class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.mes_postes') ? 'active' : '' }}">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-clipboard-list text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">Mes Candidatures</div>
                    <div class="text-xs text-gray-200">Suivi des postes</div>
                </div>
                <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <a href="{{ route('candidat.suivi_candidature') }}" 
               class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.suivi_candidature') ? 'active' : '' }}">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-hourglass-half text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">Suivi Candidature</div>
                    <div class="text-xs text-gray-200">Statut des candidatures</div>
                </div>
                <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </a>
            <a href="{{ route('candidat.profile') }}" 
               class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.profile') ? 'active' : '' }}">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div class="flex-1">
                    <div class="font-medium">Mon Profil</div>
                    <div class="text-xs text-gray-200">Gérer mes informations</div>
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
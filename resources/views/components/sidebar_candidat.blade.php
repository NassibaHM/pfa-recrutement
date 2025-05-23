<!-- Sidebar pour les candidats -->
<ul class="space-y-2 text-sm text-white">
    <li><a class="block py-2 px-4 hover:bg-green-500" href="{{ route('candidat.welcome') }}">🏠 Accueil</a></li>
    <li><a class="block py-2 px-4 hover:bg-green-500" href="{{ route('candidat.offres') }}">🔍 Offres</a></li>
    <li><a class="block py-2 px-4 hover:bg-green-500" href="{{ route('candidat.mes_postes') }}">📝 Mes Candidatures</a></li>
    <li><a class="block py-2 px-4 hover:bg-green-500" href="{{ route('candidat.suivi_candidature') }}">⏳ Suivi de Ma Candidature</a></li>
    <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block p-3 w-full text-left rounded-lg text-red-600 hover:bg-gray-200">🚪 Déconnexion</button>
        </form>
    </li>
</ul>
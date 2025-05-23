<!-- resources/views/layouts/candidat.blade.php -->
<nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">👤 Espace Candidat</h1>
    <ul class="flex space-x-6">
        <li><a href="{{ route('candidat.welcome') }}" class="hover:underline">🏠 Accueil</a></li>
        <li><a href="{{ route('candidat.offres') }}" class="hover:underline">📄 Offres</a></li>
        <li><a href="{{ route('candidat.postules') }}" class="hover:underline">📝 Postes postulés</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">🚪 Déconnexion</button>
            </form>
        </li>
    </ul>
</nav>

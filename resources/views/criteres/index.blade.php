@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Tableau de Bord</h2>
        </div>
    </x-slot>

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-5">
            <h3 class="text-xl font-semibold text-gray-700">Navigation</h3>
            <ul class="mt-4 space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">🏠 Accueil</a>
                </li>
                <li>
                    <a href="{{ route('criteres.index') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">💼 Offres</a>
                </li>
                
                <li>
                    <a href="{{ route('candidats.index') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">👤 Candidats</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block p-3 w-full text-left rounded-lg text-red-600 hover:bg-gray-200">🚪 Déconnexion</button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-700">Liste des Profiles</h3>
                <div class="flex justify-between items-center mb-4">
                    <form method="GET" action="{{ route('criteres.index') }}" class="flex space-x-4">
                        <input type="text" name="search_profile" placeholder="Recherche par Profile" class="px-4 py-2 border border-gray-300 rounded-lg" value="{{ request('search_profile') }}">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Rechercher</button>
                    </form>
                    <a href="{{ route('criteres.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Ajouter un profile
                    </a>
                </div>

                @if ($criteres->isEmpty())
                    <p class="text-gray-500">Aucun poste trouvé.</p>
                @else
                    <div class="overflow-x-auto max-h-[500px]">
                        <table class="w-full border-collapse border border-gray-300 text-base">
                            <thead>
                                <tr class="bg-gray-200 text-xs uppercase">
                                    <th class="border border-gray-300 p-4">Profile</th>
                                    <th class="border border-gray-300 p-4">Description</th>
                                    <th class="border border-gray-300 p-4">Date Sélection</th>
                                    <th class="border border-gray-300 p-4">Date Entretien</th>
                                    <th class="border border-gray-300 p-4">Date Test</th>
                                    <th class="border border-gray-300 p-4">Local Entretien</th>
                                    <th class="border border-gray-300 p-4">Nombre Candidats</th>
                                    <th class="border border-gray-300 p-4">Compétences</th>
                                    <th class="border border-gray-300 p-4">Actions</th>
                                    <th class="border border-gray-300 p-4">Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteres as $critere)
                                    <tr class="bg-white hover:bg-gray-100">
                                        <td class="border border-gray-300 p-4">{{ $critere->profile }}</td>
                                        <td class="border border-gray-300 p-4">{{ Str::limit($critere->description, 50) }}</td>
                                        <td class="border border-gray-300 p-4">{{ $critere->date_selection }}</td>
                                        <td class="border border-gray-300 p-4">{{ $critere->date_entretien }}</td>
                                        <td class="border border-gray-300 p-4">{{ $critere->date_test }}</td>
                                        <td class="border border-gray-300 p-4">{{ $critere->local_entretien }}</td>
                                        <td class="border border-gray-300 p-4">{{ $critere->nombre_candidats }}</td>
                                        <td class="border border-gray-300 p-4">
                                            <ul class="list-inside space-y-2">
                                                <li><strong>Compétences Techniques:</strong> {{ $critere->competences_techniques }}</li>
                                                <li><strong>Compétences Linguistiques:</strong> {{ $critere->competences_linguistiques }}</li>
                                                <li><strong>Compétences Managériales:</strong> {{ $critere->competences_manageriales }}</li>
                                            </ul>
                                        </td>
                                        <td class="border border-gray-300 p-4 flex justify-start space-x-4">
                                            <a href="{{ route('criteres.edit', $critere->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                                            <form action="{{ route('criteres.destroy', $critere->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Êtes-vous sûr de supprimer ce post?')">Supprimer</button>
                                            </form>
                                        </td>
                                        <td class="border border-gray-300 p-4 text-center">
                                            <a href="{{ route('criteres.show', $critere->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 w-full text-center block">
                                                Voir Détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $criteres->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
@endsection

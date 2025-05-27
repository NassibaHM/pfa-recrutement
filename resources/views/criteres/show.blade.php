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
                    <a href="{{ route('candidats.list') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">👤 Candidats</a>
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
            
            <!-- Détails des critères -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold mb-4">Détails des critères du poste</h3>

                            <!-- Tableau des critères -->
                            <table class="min-w-full table-auto border-collapse border border-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 border border-gray-300 text-left">Critère</th>
                                        <th class="px-4 py-2 border border-gray-300 text-left">Détail</th>
                                        <th class="px-4 py-2 border border-gray-300 text-left">Poids (sur 100)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $poids = $criteres->poids ?? []; @endphp

                                    @php
                                        $rows = [
                                            ['label' => 'Nom du profil', 'value' => $criteres->profile ?? 'Non spécifié', 'key' => 'profile'],
                                            ['label' => 'Description du poste', 'value' => $criteres->description ?? 'Non spécifié', 'key' => 'description'],
                                            ['label' => 'Nombre de candidats demandés', 'value' => $criteres->nombre_candidats ?? 'Non spécifié', 'key' => 'nombre_candidats'],
                                            ['label' => 'Date de sélection', 'value' => $criteres->date_selection ?? 'Non spécifié', 'key' => 'date_selection'],
                                            ['label' => 'Date de l\'entretien', 'value' => $criteres->date_entretien ?? 'Non spécifié', 'key' => 'date_entretien'],
                                            ['label' => 'Date du test technique', 'value' => $criteres->date_test ?? 'Non spécifié', 'key' => 'date_test'],
                                            ['label' => 'Local de l\'entretien', 'value' => $criteres->local_entretien ?? 'Non spécifié', 'key' => 'local_entretien'],
                                            ['label' => 'Pièces à apporter', 'value' => $criteres->pieces_apporter ?? 'Non spécifié', 'key' => 'pieces_apporter'],
                                            ['label' => 'Compétences techniques', 'value' => $criteres->competences_techniques ?? 'Non spécifié', 'key' => 'competences_techniques'],
                                            ['label' => 'Compétences linguistiques', 'value' => $criteres->competences_linguistiques ?? 'Non spécifié', 'key' => 'competences_linguistiques'],
                                            ['label' => 'Compétences managériales', 'value' => $criteres->competences_manageriales ?? 'Non spécifié', 'key' => 'competences_manageriales'],
                                            ['label' => 'Expérience professionnelle (en années)', 'value' => $criteres->experience ?? 'Non spécifié', 'key' => 'experience'],
                                        ];
                                    @endphp

                                    @foreach ($rows as $row)
                                        <tr>
                                            <td class="px-4 py-2 border border-gray-300 font-semibold">{{ $row['label'] }}</td>
                                            <td class="px-4 py-2 border border-gray-300">{{ $row['value'] }}</td>
                                            <td class="px-4 py-2 border border-gray-300">{{ $poids[$row['key']] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach

                                    <!-- Formation traitée à part à cause du tableau -->
                                    <tr>
                                        <td class="px-4 py-2 border border-gray-300 font-semibold">Formation</td>
                                        <td class="px-4 py-2 border border-gray-300">
                                            @if(!empty($criteres->formation))
                                                @foreach($criteres->formation as $formation)
                                                    {{ trim($formation) }}@if(!$loop->last), @endif
                                                @endforeach
                                            @else
                                                Aucune formation spécifiée.
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border border-gray-300">{{ $poids['formation'] ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

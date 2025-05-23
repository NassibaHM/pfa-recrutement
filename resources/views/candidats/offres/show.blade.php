@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $offre->profile }}</h1>

        <p class="text-gray-700 mb-4">{{ $offre->description }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Sections des compétences -->
            <div class="bg-blue-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">📌 Compétences Techniques</h2>
                <p class="text-gray-700">{{ $offre->competences_techniques }}</p>
            </div>
            <div class="bg-green-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">🗣️ Compétences Linguistiques</h2>
                <p class="text-gray-700">{{ $offre->competences_linguistiques }}</p>
            </div>
            <div class="bg-yellow-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">📋 Compétences Managériales</h2>
                <p class="text-gray-700">{{ $offre->competences_manageriales }}</p>
            </div>
            <div class="bg-purple-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">🎓 Formation</h2>
                @if(is_array($offre->formation))
                    <ul class="list-disc list-inside text-gray-700">
                        @foreach($offre->formation as $formation)
                            <li>{{ $formation }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $offre->formation }}</p>
                @endif
            </div>
            <div class="bg-pink-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">📅 Dates importantes</h2>
                <ul class="text-gray-700">
                    <li><strong>Entretien :</strong> {{ $offre->date_entretien }}</li>
                    <li><strong>Test :</strong> {{ $offre->date_test }}</li>
                    <li><strong>Sélection :</strong> {{ $offre->date_selection }}</li>
                </ul>
            </div>
            <div class="bg-gray-50 p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">📍 Lieu entretien</h2>
                <p class="text-gray-700">{{ $offre->local_entretien ?? 'Non spécifié' }}</p>
            </div>
        </div>

        <!-- Boutons en bas -->
        <div class="flex justify-between mt-8">
            <!-- Bouton retour -->
            <a href="{{ route('candidat.offres') }}" 
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Retour
            </a>

            <!-- Bouton postuler -->
            <a href="{{ route('candidature.create', $offre->id) }}" 
               class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition">
                Postuler
            </a>
        </div>

    </div>
</div>
@endsection

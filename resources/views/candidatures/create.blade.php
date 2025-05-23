@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded shadow">

    <h2 class="text-2xl font-semibold mb-6">Postuler à l'offre</h2>

    @if($critere)
        <div class="bg-gray-100 p-4 rounded mb-6">
            <h4 class="font-semibold">Critères pour le poste : {{ $critere->profile }}</h4>
            <p>Compétences Techniques : {{ $critere->competences_techniques }}</p>
            <p>Compétences Linguistiques : {{ $critere->competences_linguistiques }}</p>
            <p>Compétences Managériales : {{ $critere->competences_manageriales }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('candidatures.postuler', $offre_id) }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block">Nom</label>
                <input type="text" name="nom" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Téléphone</label>
                <input type="text" name="telephone" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Adresse</label>
                <input type="text" name="adresse" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Date de naissance</label>
                <input type="date" name="date_naissance" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Formation</label>
                <input type="text" name="formation" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Compétences techniques (sur 10)</label>
                <input type="number" name="competences_techniques" min="0" max="10" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Compétences linguistiques (sur 10)</label>
                <input type="number" name="competences_linguistiques" min="0" max="10" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Compétences managériales (sur 10)</label>
                <input type="number" name="competences_manageriales" min="0" max="10" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block">Années d'expérience</label>
                <input type="number" name="experience" min="0" class="w-full border p-2 rounded" required>
            </div>

            <div class="md:col-span-2">
                <label class="block">Certifications</label>
                <textarea name="certifications" class="w-full border p-2 rounded"></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block">Autres informations</label>
                <textarea name="autres_informations" class="w-full border p-2 rounded"></textarea>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Soumettre ma candidature</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Formulaire de candidature pour l'offre : {{ $offre->profile }}</h2>

    <!-- Display Success or Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('candidature.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <!-- ID de l'offre (hidden) -->
        <div class="mb-4">
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">
        </div>

        <!-- Autres champs du formulaire (pré-remplis si nécessaire) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block">Nom complet</label>
                <input type="text" name="nom" class="w-full border p-2 rounded" value="{{ old('nom') }}" required>
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="block">Téléphone</label>
                <input type="text" name="telephone" class="w-full border p-2 rounded" value="{{ old('telephone') }}" required>
            </div>

            <div>
                <label class="block">Adresse</label>
                <input type="text" name="adresse" class="w-full border p-2 rounded" value="{{ old('adresse') }}">
            </div>

            <div>
                <label class="block">Date de naissance</label>
                <input type="date" name="date_naissance" class="w-full border p-2 rounded" value="{{ old('date_naissance') }}">
            </div>

            <div>
                <label class="block">Formation</label>
                <input type="text" name="formation" class="w-full border p-2 rounded" value="{{ old('formation', $offre->formation) }}">
            </div>

            <div>
                <label class="block">Expérience</label>
                <input type="text" name="experience" class="w-full border p-2 rounded" value="{{ old('experience', $offre->experience) }}">
            </div>

            <div>
                <label class="block">Compétences Techniques</label>
                <input type="text" name="competences_techniques" class="w-full border p-2 rounded" value="{{ old('competences_techniques', $offre->competences_techniques) }}">
            </div>

            <div>
                <label class="block">Compétences Linguistiques</label>
                <input type="text" name="competences_linguistiques" class="w-full border p-2 rounded" value="{{ old('competences_linguistiques', $offre->competences_linguistiques) }}">
            </div>

            <div>
                <label class="block">Compétences Managériales</label>
                <input type="text" name="competences_manageriales" class="w-full border p-2 rounded" value="{{ old('competences_manageriales', $offre->competences_manageriales) }}">
            </div>

            <div class="md:col-span-2">
                <label class="block">Photo (format JPG, PNG...)</label>
                <input type="file" name="photo" accept="image/*" class="w-full border p-2 rounded">
            </div>

            <div>
                <label class="block">Certifications</label>
                <input type="text" name="certifications" class="w-full border p-2 rounded" value="{{ old('certifications') }}">
            </div>

            <div class="md:col-span-2">
                <label class="block">Autres informations</label>
                <textarea name="autres_informations" class="w-full border p-2 rounded" rows="3">{{ old('autres_informations') }}</textarea>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Envoyer ma candidature
            </button>
        </div>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Formulaire de candidature pour l'offre : {{ $offre->profile }}</h2>

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

        <input type="hidden" name="offre_id" value="{{ $offre->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block">Nom complet</label>
                <input type="text" name="nom" class="w-full border p-2 rounded" value="{{ old('nom') }}" required>
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email') }}" required>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Téléphone</label>
                <input type="text" name="telephone" class="w-full border p-2 rounded" value="{{ old('telephone') }}" required>
                @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Adresse</label>
                <input type="text" name="adresse" class="w-full border p-2 rounded" value="{{ old('adresse') }}">
                @error('adresse') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Date de naissance</label>
                <input type="date" name="date_naissance" class="w-full border p-2 rounded" value="{{ old('date_naissance') }}">
                @error('date_naissance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Formation (e.g., Master en Informatique)</label>
                <input type="text" name="formation" class="w-full border p-2 rounded" value="{{ old('formation') }}" required>
                @error('formation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Expérience (en années)</label>
                <input type="number" name="experience" min="0" class="w-full border p-2 rounded" value="{{ old('experience') }}" required>
                @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Compétences Techniques (séparées par des virgules)</label>
                <input type="text" name="competences_techniques" placeholder="Python, Java, SQL" class="w-full border p-2 rounded" value="{{ old('competences_techniques') }}" required>
                @error('competences_techniques') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Compétences Linguistiques (séparées par des virgules)</label>
                <input type="text" name="competences_linguistiques" placeholder="Anglais, Français" class="w-full border p-2 rounded" value="{{ old('competences_linguistiques') }}" required>
                @error('competences_linguistiques') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Compétences Managériales (séparées par des virgules)</label>
                <input type="text" name="competences_manageriales" placeholder="Leadership, Gestion de projet" class="w-full border p-2 rounded" value="{{ old('competences_manageriales') }}">
                @error('competences_manageriales') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block">Photo (format JPG, PNG...)</label>
                <input type="file" name="photo" accept="image/*" class="w-full border p-2 rounded">
                @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Certifications</label>
                <input type="text" name="certifications" class="w-full border p-2 rounded" value="{{ old('certifications') }}">
                @error('certifications') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block">Autres informations</label>
                <textarea name="autres_informations" class="w-full border p-2 rounded" rows="3">{{ old('autres_informations') }}</textarea>
                @error('autres_informations') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

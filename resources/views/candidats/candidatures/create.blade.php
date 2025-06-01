@extends('layouts.app')

@section('content')
    <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-[#0f172a] mb-6">
            <i class="fas fa-file-alt mr-2 text-[#f59e0b]"></i>Postuler à {{ $offre->criteres->profile ?? 'Offre' }}
        </h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 animate-fade-up">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate-fade-up">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate-fade-up">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('candidatures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="nom" class="input-modern mt-1 block w-full rounded-md" value="{{ old('nom') }}" required>
                    @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="input-modern mt-1 block w-full rounded-md" value="{{ old('email') }}" required>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" name="telephone" class="input-modern mt-1 block w-full rounded-md" value="{{ old('telephone') }}" required>
                    @error('telephone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" name="adresse" class="input-modern mt-1 block w-full rounded-md" value="{{ old('adresse') }}">
                    @error('adresse') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date de naissance</label>
                    <input type="date" name="date_naissance" class="input-modern mt-1 block w-full rounded-md" value="{{ old('date_naissance') }}">
                    @error('date_naissance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Formation (e.g., Master en Informatique)</label>
                    <input type="text" name="formation" class="input-modern mt-1 block w-full rounded-md" value="{{ old('formation') }}" required>
                    @error('formation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Expérience (en années)</label>
                    <input type="number" name="experience" min="0" class="input-modern mt-1 block w-full rounded-md" value="{{ old('experience') }}" required>
                    @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Compétences Techniques (séparées par des virgules)</label>
                    <input type="text" name="competences_techniques" placeholder="Python, Java, SQL" class="input-modern mt-1 block w-full rounded-md" value="{{ old('competences_techniques') }}" required>
                    @error('competences_techniques') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Compétences Linguistiques (séparées par des virgules)</label>
                    <input type="text" name="competences_linguistiques" placeholder="Anglais, Français" class="input-modern mt-1 block w-full rounded-md" value="{{ old('competences_linguistiques') }}" required>
                    @error('competences_linguistiques') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Compétences Managériales (séparées par des virgules)</label>
                    <input type="text" name="competences_manageriales" placeholder="Leadership, Gestion de projet" class="input-modern mt-1 block w-full rounded-md" value="{{ old('competences_manageriales') }}">
                    @error('competences_manageriales') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Photo (format JPG, PNG...)</label>
                    <input type="file" name="photo" accept="image/*" class="input-modern mt-1 block w-full rounded-md">
                    @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Certifications</label>
                    <input type="text" name="certifications" class="input-modern mt-1 block w-full rounded-md" value="{{ old('certifications') }}">
                    @error('certifications') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Autres informations</label>
                    <textarea name="autres_informations" class="input-modern mt-1 block w-full rounded-md" rows="3">{{ old('autres_informations') }}</textarea>
                    @error('autres_informations') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="nav-button bg-[#1e40af] text-white px-4 py-2 rounded hover:bg-[#1e3a8a] transition-all">
                    Envoyer ma candidature
                </button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        /* Ensure textarea matches input-modern */
        .input-modern textarea {
            border: 1px solid rgba(30, 64, 175, 0.3);
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .input-modern textarea:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
            outline: none;
        }
    </style>
@endpush
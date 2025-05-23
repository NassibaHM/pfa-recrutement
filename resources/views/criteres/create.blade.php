@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-bold mb-6">{{ __('Définir les critères du poste') }}</h2>

                <form action="{{ route('criteres.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="profile" class="block font-semibold">Nom du profil</label>
                        <input id="profile" type="text" name="profile" value="{{ old('profile') }}" required class="w-full px-4 py-2 border rounded-lg">
                        @error('profile') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-semibold">Description du poste</label>
                        <textarea id="description" name="description" rows="3" required class="w-full px-4 py-2 border rounded-lg">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nombre_candidats" class="block font-semibold">Nombre de postes</label>
                        <input id="nombre_candidats" type="number" name="nombre_candidats" min="1" value="{{ old('nombre_candidats') }}" required class="w-full px-4 py-2 border rounded-lg">
                        @error('nombre_candidats') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="date_selection" class="block font-semibold">Date de sélection</label>
                            <input id="date_selection" type="date" name="date_selection" value="{{ old('date_selection') }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label for="date_entretien" class="block font-semibold">Date d'entretien</label>
                            <input id="date_entretien" type="date" name="date_entretien" value="{{ old('date_entretien') }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label for="date_test" class="block font-semibold">Date du test</label>
                            <input id="date_test" type="date" name="date_test" value="{{ old('date_test') }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label for="local_entretien" class="block font-semibold">Lieu d'entretien</label>
                            <input id="local_entretien" type="text" name="local_entretien" value="{{ old('local_entretien') }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="pieces_apporter" class="block font-semibold">Pièces à fournir</label>
                        <input id="pieces_apporter" type="text" name="pieces_apporter" value="{{ old('pieces_apporter') }}" required class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    {{-- Compétences --}}
                    <div class="mb-4">
                        <label class="block font-semibold">Compétences</label>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <input type="text" name="competences_techniques" placeholder="Techniques" value="{{ old('competences_techniques') }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                <input type="number" name="poids_competence_technique" min="0" max="100" value="{{ old('poids_competence_technique') }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div>
                                <input type="text" name="competences_linguistiques" placeholder="Linguistiques" value="{{ old('competences_linguistiques') }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                <input type="number" name="poids_competence_linguistique" min="0" max="100" value="{{ old('poids_competence_linguistique') }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div>
                                <input type="text" name="competences_manageriales" placeholder="Managériales" value="{{ old('competences_manageriales') }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                <input type="number" name="poids_competence_manageriale" min="0" max="100" value="{{ old('poids_competence_manageriale') }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                            </div>
                        </div>
                    </div>

                    {{-- Formation --}}
                    <div class="mb-4">
                        <label class="block font-semibold">Formation requise</label>
                        @php
                            $formations = ['BTS/DUT', 'Licence', 'Master', 'Ingénieur', 'Doctorat'];
                        @endphp
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($formations as $formation)
                                <div>
                                    <input type="checkbox" name="formation[]" id="formation_{{ $formation }}" value="{{ $formation }}" class="w-4 h-4"
                                        {{ is_array(old('formation')) && in_array($formation, old('formation')) ? 'checked' : '' }}>
                                    <label for="formation_{{ $formation }}">{{ $formation }}</label>
                                </div>
                            @endforeach
                        </div>
                        <label for="poids_formation" class="block mt-2 font-medium">Pondération formation (%)</label>
                        <input id="poids_formation" type="number" name="poids_formation" min="0" max="100" value="{{ old('poids_formation') }}" required class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    {{-- Expérience --}}
                    <div class="mb-4">
                        <label for="experience" class="block font-semibold">Expérience (en années)</label>
                        <input id="experience" type="number" name="experience" min="0" value="{{ old('experience') }}" required class="w-full px-4 py-2 border rounded-lg">

                        <label for="poids_experience" class="block mt-2 font-medium">Pondération expérience (%)</label>
                        <input id="poids_experience" type="number" name="poids_experience" min="0" max="100" value="{{ old('poids_experience') }}" required class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    {{-- Pondération totale --}}
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Somme pondérations : <span id="somme-ponderation">0 %</span></p>
                        <p id="message-erreur" class="text-red-600 text-sm"></p>
                    </div>
                
                    <button type="submit" id="btn-submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        function calculerPonderation() {
            let total = 0;
            const champs = [
                'input[name="poids_formation"]',
                'input[name="poids_experience"]',
                'input[name="poids_competence_technique"]',
                'input[name="poids_competence_linguistique"]',
                'input[name="poids_competence_manageriale"]'
            ];
            champs.forEach(selector => {
                total += parseInt($(selector).val()) || 0;
            });
            $('#somme-ponderation').text(`${total} %`);
            if (total !== 100) {
                $('#message-erreur').text('⚠️ La somme des pondérations doit être exactement 100 %.');
                $('#btn-submit').prop('disabled', true);
            } else {
                $('#message-erreur').text('');
                $('#btn-submit').prop('disabled', false);
            }
        }

        $('input[type="number"]').on('input', calculerPonderation);
        calculerPonderation();
    });
</script>

@endsection
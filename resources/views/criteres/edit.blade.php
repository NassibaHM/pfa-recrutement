@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier les critères du poste') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Modifier les critères du poste</h3>

                    <!-- Formulaire -->
                    <form action="{{ route('criteres.update', $criteres->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="profile" class="block text-gray-700 font-semibold">Profil</label>
                            <input type="text" name="profile" id="profile" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('profile', $criteres->profile) }}">
                        </div>

                        <!-- Description du poste et nombre de candidats -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-semibold">Description du poste</label>
                            <textarea name="description" id="description" rows="3" required class="w-full px-4 py-2 border rounded-lg">{{ old('description', $criteres->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="nombre_candidats" class="block text-gray-700 font-semibold">Nombre de candidats demandés</label>
                            <input type="number" name="nombre_candidats" id="nombre_candidats" min="1" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('nombre_candidats', $criteres->nombre_candidats) }}">
                        </div>

                        <!-- Dates et local -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="date_selection" class="block text-gray-700 font-semibold">Date de sélection</label>
                                <input type="date" name="date_selection" id="date_selection" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('date_selection', $criteres->date_selection) }}">
                            </div>
                            <div>
                                <label for="date_entretien" class="block text-gray-700 font-semibold">Date de l'entretien</label>
                                <input type="date" name="date_entretien" id="date_entretien" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('date_entretien', $criteres->date_entretien) }}">
                            </div>
                            <div>
                                <label for="date_test" class="block text-gray-700 font-semibold">Date du test technique</label>
                                <input type="date" name="date_test" id="date_test" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('date_test', $criteres->date_test) }}">
                            </div>
                            <div>
                                <label for="local_entretien" class="block text-gray-700 font-semibold">Lieu de l'entretien</label>
                                <input type="text" name="local_entretien" id="local_entretien" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('local_entretien', $criteres->local_entretien) }}">
                            </div>
                        </div>

                        <!-- Pièces à apporter -->
                        <div class="mb-4">
                            <label for="pieces_apporter" class="block text-gray-700 font-semibold">Pièces à apporter</label>
                            <input type="text" name="pieces_apporter" id="pieces_apporter" required class="w-full px-4 py-2 border rounded-lg" value="{{ old('pieces_apporter', $criteres->pieces_apporter) }}">
                        </div>

                        <!-- Compétences -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold">Compétences</label>
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <input type="text" name="competences_techniques" placeholder="Techniques" value="{{ old('competences_techniques', $criteres->competences_techniques) }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                    <input type="number" name="poids_competence_technique" min="0" max="100" value="{{ old('poids_competence_technique', $criteres->poids_competence_technique) }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                                <div>
                                    <input type="text" name="competences_linguistiques" placeholder="Linguistiques" value="{{ old('competences_linguistiques', $criteres->competences_linguistiques) }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                    <input type="number" name="poids_competence_linguistique" min="0" max="100" value="{{ old('poids_competence_linguistique', $criteres->poids_competence_linguistique) }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                                <div>
                                    <input type="text" name="competences_manageriales" placeholder="Managériales" value="{{ old('competences_manageriales', $criteres->competences_manageriales) }}" required class="w-full px-4 py-2 border rounded-lg mb-2">
                                    <input type="number" name="poids_competence_manageriale" min="0" max="100" value="{{ old('poids_competence_manageriale', $criteres->poids_competence_manageriale) }}" required placeholder="Poids (%)" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                            </div>
                        </div>

                        <!-- Formation -->
                        <div class="mb-4">
                            <label class="block font-semibold">Formation requise</label>
                            @php
                                $formations = ['BTS/DUT', 'Licence', 'Master', 'Ingénieur', 'Doctorat'];
                                $checkedFormations = is_string($criteres->formation)? json_decode($criteres->formation, true): ($criteres->formation ?? []);                           
                            @endphp
                            <div class="grid grid-cols-3 gap-2">
                                @foreach ($formations as $formation)
                                    <div>
                                        <input type="checkbox" name="formation[]" id="formation_{{ $formation }}" value="{{ $formation }}"
                                            {{ is_array(old('formation', $checkedFormations)) && in_array($formation, old('formation', $checkedFormations)) ? 'checked' : '' }}>
                                        <label for="formation_{{ $formation }}">{{ $formation }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <label for="poids_formation" class="block mt-2 font-medium">Pondération formation (%)</label>
                            <input id="poids_formation" type="number" name="poids_formation" min="0" max="100" value="{{ old('poids_formation', $criteres->poids_formation) }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <!-- Expérience -->
                        <div class="mb-4">
                            <label for="experience" class="block font-semibold">Expérience (en années)</label>
                            <input id="experience" type="number" name="experience" min="0" value="{{ old('experience', $criteres->experience) }}" required class="w-full px-4 py-2 border rounded-lg">

                            <label for="poids_experience" class="block mt-2 font-medium">Pondération expérience (%)</label>
                            <input id="poids_experience" type="number" name="poids_experience" min="0" max="100" value="{{ old('poids_experience', $criteres->poids_experience) }}" required class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <!-- Total pondération -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Somme pondérations : <span id="somme-ponderation">0 %</span></p>
                            <p id="message-erreur" class="text-red-600 text-sm"></p>
                        </div>

                        <button type="submit" id="btn-submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script de validation --}}
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

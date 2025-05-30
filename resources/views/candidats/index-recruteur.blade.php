@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Gestion des Candidats</h2>
        </div>
    </x-slot>

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-5">
            <h3 class="text-xl font-semibold text-gray-700">Navigation</h3>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('dashboard') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">🏠 Accueil</a></li>
                <li><a href="{{ route('criteres.index') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">💼 Offres</a></li>
                <li><a href="{{ route('candidats.list') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">👤 Candidats</a></li>
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
                <!-- Filter by Offer -->
                <div class="mb-4">
                    <label for="offre_id" class="block text-sm font-medium text-gray-700">Filtrer par offre :</label>
                    <select name="offre_id" id="offre_id" onchange="window.location.href='{{ url('/candidats') }}/' + this.value" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Toutes les offres</option>
                        @foreach ($offres as $offre)
                            <option value="{{ $offre->id }}" {{ isset($offreId) && $offreId == $offre->id ? 'selected' : '' }}>{{ $offre->profile }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Rank Button -->
                @if (isset($offreId))
                    @php
                        $critere = $criteres->firstWhere('offre_id', $offreId);
                    @endphp
                    @if ($critere && !$candidatures->isEmpty())
                        <div class="mb-4">
                            <form method="POST" action="{{ route('critere.rank', ['critereId' => $critere->id]) }}">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Classer Candidats</button>
                            </form>
                        </div>
                    @elseif ($critere && $candidatures->isEmpty())
                        <p class="text-gray-600 mb-4">Aucune candidature pour cette offre.</p>
                    @else
                        <p class="text-red-600 mb-4">Aucun critère défini pour cette offre. <a href="{{ route('criteres.create') }}" class="underline">Ajouter un critère</a>.</p>
                    @endif
                @endif

                <!-- Candidates List -->
                @if ($candidatures->isEmpty())
                    <p class="text-gray-600">Aucun candidat pour cette offre.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sélection</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entretien RH</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Technique</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($candidatures as $candidature)
                                    @php
                                        $selectionStatus = $candidature->statuses()->where('phase', 'selection')->latest()->first();
                                        $entretienRHStatus = $candidature->statuses()->where('phase', 'entretien_rh')->latest()->first();
                                        $testTechniqueStatus = $candidature->statuses()->where('phase', 'test_technique')->latest()->first();
                                        $disableEntretienRH = $selectionStatus && $selectionStatus->status === 'non retenu';
                                        $disableTestTechnique = $entretienRHStatus && $entretienRHStatus->status === 'non retenu';
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $candidature->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $candidature->user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $candidature->score_pertinence ? number_format($candidature->score_pertinence, 2).'%' : 'Non classé' }}</td>                                        <td class="px-6 py-4 whitespace-nowrap">{{ $candidature->rank ?? 'Non classé' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select name="status_{{ $candidature->id }}_selection" onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'selection', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')" class="border p-2 rounded">
                                                <option value="en attente" {{ !$selectionStatus ? 'selected' : '' }}>En attente</option>
                                                <option value="retenu" {{ $selectionStatus && $selectionStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                                                <option value="non retenu" {{ $selectionStatus && $selectionStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                                            </select>
                                            <input type="checkbox" name="retained_{{ $candidature->id }}_selection" {{ $selectionStatus && $selectionStatus->retained ? 'checked' : '' }} onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_selection\"]').value, 'selection', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select name="status_{{ $candidature->id }}_entretien_rh" onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'entretien_rh', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')" class="border p-2 rounded" {{ $disableEntretienRH ? 'disabled' : '' }}>
                                                <option value="en attente" {{ !$entretienRHStatus ? 'selected' : '' }}>En attente</option>
                                                <option value="retenu" {{ $entretienRHStatus && $entretienRHStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                                                <option value="non retenu" {{ $entretienRHStatus && $entretienRHStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                                            </select>
                                            <input type="checkbox" name="retained_{{ $candidature->id }}_entretien_rh" {{ $entretienRHStatus && $entretienRHStatus->retained ? 'checked' : '' }} onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_entretien_rh\"]').value, 'entretien_rh', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)" {{ $disableEntretienRH ? 'disabled' : '' }}>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <select name="status_{{ $candidature->id }}_test_technique" onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'test_technique', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')" class="border p-2 rounded" {{ $disableTestTechnique ? 'disabled' : '' }}>
                                                <option value="en attente" {{ !$testTechniqueStatus ? 'selected' : '' }}>En attente</option>
                                                <option value="retenu" {{ $testTechniqueStatus && $testTechniqueStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                                                <option value="non retenu" {{ $testTechniqueStatus && $testTechniqueStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                                            </select>
                                            <input type="checkbox" name="retained_{{ $candidature->id }}_test_technique" {{ $testTechniqueStatus && $testTechniqueStatus->retained ? 'checked' : '' }} onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_test_technique\"]').value, 'test_technique', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)" {{ $disableTestTechnique ? 'disabled' : '' }}>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <button type="button" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600" onclick="viewCandidateDetails({{ $candidature->id }})">Voir détails</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <!-- Buttons -->
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Retourner vers Dashboard</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Candidate Details -->
    <div id="candidateDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h3 class="text-lg font-semibold mb-4">Détails du Candidat</h3>
            <div id="candidateDetailsContent" class="space-y-4">
                <!-- Candidate details will be loaded here via AJAX -->
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="closeCandidateDetailsModal()">Fermer</button>
            </div>
        </div>
    </div>

    <script>
        let currentCandidatureId = null;
        let currentPhase = null;

        function updateStatusAndShowModal(candidatureId, status, phase, url, retained) {
            currentCandidatureId = candidatureId;
            currentPhase = phase;
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: status,
                    phase: phase,
                    retained: retained
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Statut mis à jour avec succès.');
                    location.reload(); // Recharge la page pour refléter les changements
                } else {
                    alert('Erreur lors de la mise à jour: ' + (data.message || ''));
                }
            })
            .catch(error => console.error('Fetch error:', error));
        }

        function viewCandidateDetails(candidatureId) {
            const url = '{{ route("candidats.details", ":id") }}'.replace(':id', candidatureId);
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const photoUrl = data.candidature.photo ? '{{ url('') }}/storage/' + data.candidature.photo : null;
                    const content = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <strong>Photo:</strong><br>
                                    ${photoUrl ? `<img src="${photoUrl}" alt="Photo du candidat" class="w-24 h-24 rounded-full object-cover" onerror="this.parentElement.innerHTML='<span>Aucune photo disponible</span>'">` : '<span>Aucune photo disponible</span>'}
                                </div>
                                <div>
                                    <strong>Nom complet:</strong> ${data.candidature.nom || 'Non spécifié'}
                                </div>
                            </div>
                            <div><strong>Email:</strong> ${data.candidature.email || 'Non spécifié'}</div>
                            <div><strong>Téléphone:</strong> ${data.candidature.telephone || 'Non spécifié'}</div>
                            <div><strong>Adresse:</strong> ${data.candidature.adresse || 'Non spécifié'}</div>
                            <div><strong>Date de naissance:</strong> ${data.candidature.date_naissance || 'Non spécifié'}</div>
                            <div><strong>Formation:</strong> ${data.candidature.formation || 'Non spécifié'}</div>
                            <div><strong>Expérience:</strong> ${data.candidature.experience || 'Non spécifié'}</div>
                            <div><strong>Compétences Techniques:</strong> ${data.candidature.competences_techniques || 'Non spécifié'}</div>
                            <div><strong>Compétences Linguistiques:</strong> ${data.candidature.competences_linguistiques || 'Non spécifié'}</div>
                            <div><strong>Compétences Managériales:</strong> ${data.candidature.competences_manageriales || 'Non spécifié'}</div>
                            <div><strong>Certifications:</strong> ${data.candidature.certifications || 'Non spécifié'}</div>
                            <div class="md:col-span-2"><strong>Autres informations:</strong> ${data.candidature.autres_informations || 'Non spécifié'}</div>
                        </div>
                    `;
                    document.getElementById('candidateDetailsContent').innerHTML = content;
                    document.getElementById('candidateDetailsModal').classList.remove('hidden');
                } else {
                    alert('Erreur: ' + (data.message || ''));
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function closeCandidateDetailsModal() {
            document.getElementById('candidateDetailsModal').classList.add('hidden');
            document.getElementById('candidateDetailsContent').innerHTML = '';
        }
    </script>
@endsection
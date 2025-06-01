@extends('layouts.app')

@section('content')
    <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
        <h2 class="text-2xl font-bold text-[#0f172a] mb-6">
            <i class="fas fa-clipboard-list mr-2 text-[#f59e0b]"></i>{{ __('Mes Candidatures') }}
        </h2>

        @if($candidatures->isEmpty())
            <p class="text-gray-600">Aucune candidature pour le moment.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-modern table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Poste</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Date sélection</th>
                            <th class="px-4 py-2">Date entretien</th>
                            <th class="px-4 py-2">Date test</th>
                            <th class="px-4 py-2">Lieu</th>
                            <th class="px-4 py-2">Pièces à fournir</th>
                            <th class="px-4 py-2">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidatures as $candidature)
                            <tr>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->profile ?? 'Non défini' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->description ?? 'Non défini' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->date_selection ?? 'Non définie' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->date_entretien ?? 'Non définie' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->date_test ?? 'Non définie' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->local_entretien ?? 'Non défini' }}</td>
                                <td class="px-4 py-2">{{ $candidature->offre?->criteres?->pieces_apporter ?? 'Non définies' }}</td>
                                <td class="px-4 py-2">
                                    <button onclick="showCandidatureDetails({{ $candidature->id }})" 
                                            class="text-blue-600 hover:underline font-medium">Voir</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Candidature Details Modal -->
    <div id="candidatureDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="modal-content rounded-lg shadow-lg w-3/4 max-w-3xl max-h-[80vh] overflow-y-auto">
            <div class="modal-header px-6 py-4">
                <h3 class="text-xl font-bold text-center">Détails de la candidature</h3>
            </div>
            <div class="p-6">
                <dl id="candidatureDetailsContent" class="details-list grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Details will be populated dynamically -->
                </dl>
                <div class="flex justify-end mt-6">
                    <button type="button" class="modal-close-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600" onclick="closeCandidatureDetailsModal()">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }
        .table-modern th {
            background-color: #1e40af;
            color: white;
            font-weight: 600;
        }
        .table-modern td, .table-modern th {
            border: 1px solid rgba(30, 64, 175, 0.2);
        }
        .table-modern tr:hover {
            background-color: rgba(30, 64, 175, 0.05);
        }
        .details-list dt {
            color: #1e40af;
            font-weight: 600;
        }
        .details-list dd {
            color: #374151;
            margin-bottom: 1rem;
        }
        .modal-content {
            animation: modalFadeIn 0.3s ease-out;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(240, 247, 255, 0.95));
            border: 1px solid rgba(30, 64, 175, 0.2);
        }
        .modal-header {
            background: linear-gradient(90deg, #1e40af, #4b5e99);
            color: white;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
        .modal-close-btn {
            transition: all 0.3s ease;
        }
        .modal-close-btn:hover {
            background-color: #4b5563;
            transform: scale(1.05);
        }
        .details-list > div {
            padding: 0.5rem;
            border-bottom: 1px solid rgba(30, 64, 175, 0.1);
        }
        .details-list > div:hover {
            background-color: rgba(30, 64, 175, 0.05);
        }
    </style>
@endpush

@push('scripts')
    <script>
        @php
            $candidaturesData = $candidatures->map(fn ($candidature) => [
                'id' => $candidature->id,
                'nom' => $candidature->nom ?? 'Non spécifié',
                'email' => $candidature->email ?? 'Non spécifié',
                'telephone' => $candidature->telephone ?? 'Non spécifié',
                'adresse' => $candidature->adresse ?? 'Non spécifié',
                'date_naissance' => $candidature->date_naissance ?? 'Non spécifié',
                'formation' => $candidature->formation ?? 'Non spécifié',
                'experience' => $candidature->experience ?? 'Non spécifié',
                'competences_techniques' => $candidature->competences_techniques ?? 'Non spécifié',
                'competences_linguistiques' => $candidature->competences_linguistiques ?? 'Non spécifié',
                'competences_manageriales' => $candidature->competences_manageriales ?? 'Non spécifié',
                'certifications' => $candidature->certifications ?? 'Non spécifié',
                'autres_informations' => $candidature->autres_informations ?? 'Non spécifié',
            ])->values()->toArray();
        @endphp
        const candidaturesData = @json($candidaturesData);

        function showCandidatureDetails(id) {
            const modal = document.getElementById('candidatureDetailsModal');
            const content = document.getElementById('candidatureDetailsContent');
            const candidature = candidaturesData.find(c => c.id === id);

            if (candidature) {
                content.innerHTML = `
                    <div><dt>Nom :</dt><dd>${candidature.nom}</dd></div>
                    <div><dt>Email :</dt><dd>${candidature.email}</dd></div>
                    <div><dt>Téléphone :</dt><dd>${candidature.telephone}</dd></div>
                    <div><dt>Adresse :</dt><dd>${candidature.adresse}</dd></div>
                    <div><dt>Date de naissance :</dt><dd>${candidature.date_naissance}</dd></div>
                    <div><dt>Formation :</dt><dd>${candidature.formation}</dd></div>
                    <div><dt>Expérience :</dt><dd>${candidature.experience}</dd></div>
                    <div><dt>Compétences techniques :</dt><dd>${candidature.competences_techniques}</dd></div>
                    <div><dt>Compétences linguistiques :</dt><dd>${candidature.competences_linguistiques}</dd></div>
                    <div><dt>Compétences managériales :</dt><dd>${candidature.competences_manageriales}</dd></div>
                    <div><dt>Certifications :</dt><dd>${candidature.certifications}</dd></div>
                    <div><dt>Autres informations :</dt><dd>${candidature.autres_informations}</dd></div>
                `;
            } else {
                content.innerHTML = '<p class="text-gray-600">Aucune information disponible.</p>';
            }

            modal.classList.remove('hidden');
        }

        function closeCandidatureDetailsModal() {
            const modal = document.getElementById('candidatureDetailsModal');
            modal.classList.add('hidden');
            document.getElementById('candidatureDetailsContent').innerHTML = '';
        }
    </script>
@endpush
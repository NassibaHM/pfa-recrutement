@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
            <h2 class="text-2xl font-bold text-[#0f172a] mb-6">
                <i class="fas fa-hourglass-half mr-2 text-[#f59e0b]"></i>{{ __('Suivi de Ma Candidature') }}
            </h2>

            <!-- Candidature Progress Table -->
            @if ($candidatures->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full table-modern table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Poste</th>
                                <th class="px-4 py-2">Sélection</th>
                                <th class="px-4 py-2">Entretien RH</th>
                                <th class="px-4 py-2">Test Technique</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidatures as $candidature)
                                @php
                                    $selectionStatus = $candidature->statuses()->where('phase', 'selection')->latest()->first();
                                    $entretienRHStatus = $candidature->statuses()->where('phase', 'entretien_rh')->latest()->first();
                                    $testTechniqueStatus = $candidature->statuses()->where('phase', 'test_technique')->latest()->first();
                                @endphp
                                <tr>
                                    <td class="px-4 py-2">{{ $candidature->offre->profile ?? 'Non défini' }}</td>
                                    <td class="px-4 py-2">
                                        <span class="status-text {{ $selectionStatus ? ($selectionStatus->status === 'retenu' ? 'text-green-600' : 'text-red-600') : 'text-gray-500' }}">
                                            {{ $selectionStatus ? $selectionStatus->status : 'En attente' }}
                                        </span>
                                        <div class="mt-2">
                                            <button onclick="showNotificationsModal('selection', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                                <i class="fas fa-envelope mr-1"></i>
                                                @if ($candidature->unread_notifications_count['selection'] > 0)
                                                    <span class="ml-1 notification-badge">{{ $candidature->unread_notifications_count['selection'] }}</span>
                                                @endif
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="status-text {{ $entretienRHStatus ? ($entretienRHStatus->status === 'retenu' ? 'text-green-600' : 'text-red-600') : 'text-gray-500' }}">
                                            {{ $entretienRHStatus ? $entretienRHStatus->status : 'En attente' }}
                                        </span>
                                        <div class="mt-2">
                                            <button onclick="showNotificationsModal('entretien_rh', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                                <i class="fas fa-envelope mr-1"></i>
                                                @if ($candidature->unread_notifications_count['entretien_rh'] > 0)
                                                    <span class="ml-1 notification-badge">{{ $candidature->unread_notifications_count['entretien_rh'] }}</span>
                                                @endif
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="status-text {{ $testTechniqueStatus ? ($testTechniqueStatus->status === 'retenu' ? 'text-green-600' : 'text-red-600') : 'text-gray-500' }}">
                                            {{ $testTechniqueStatus ? $testTechniqueStatus->status : 'En attente' }}
                                        </span>
                                        <div class="mt-2">
                                            <button onclick="showNotificationsModal('test_technique', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                                <i class="fas fa-envelope mr-1"></i>
                                                @if ($candidature->unread_notifications_count['test_technique'] > 0)
                                                    <span class="ml-1 notification-badge">{{ $candidature->unread_notifications_count['test_technique'] }}</span>
                                                @endif
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">Aucune candidature en cours.</p>
            @endif
        </div>
    </div>

    <!-- Notifications Modal -->
    <div id="notificationsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="modal-content rounded-lg shadow-lg w-3/4 max-w-3xl max-h-[80vh] overflow-y-auto">
            <div class="modal-header px-6 py-4">
                <h3 id="modalTitle" class="text-lg font-semibold text-center">Notifications</h3>
            </div>
            <div class="p-6">
                <div id="notificationsContent" class="mb-4">
                    <!-- Notifications will be populated dynamically -->
                </div>
                <div class="flex justify-end">
                    <button type="button" class="modal-close-btn bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600" onclick="closeNotificationsModal()">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Table Styling */
        .table-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .table-modern th {
            background: linear-gradient(90deg, #1e40af, #4b5e99);
            color: white;
            font-weight: 600;
        }

        .table-modern td, .table-modern th {
            border: 1px solid rgba(30, 64, 175, 0.2);
        }

        .table-modern tr:hover {
            background-color: rgba(30, 64, 175, 0.05);
        }

        /* Card Styling */
        .card-modern {
            background: linear-gradient(145deg, rgba(30, 64, 175, 0.2), rgba(255, 255, 255, 0.8));
            border: 1px solid rgba(30, 64, 175, 0.3);
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(30, 64, 175, 0.2);
        }

        /* Notification Badge */
        .notification-badge {
            position: relative;
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            font-size: 0.65rem;
            font-weight: bold;
            border-radius: 9999px;
            padding: 2px 6px;
            min-width: 16px;
            text-align: center;
        }

        /* Status Text */
        .status-text {
            font-weight: 500;
        }

        /* Modal Styling */
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

        .modal-content .border-b:hover {
            background-color: rgba(30, 64, 175, 0.05);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Store notifications data from Blade to avoid multiple DOM queries
        const notificationsData = @json($candidatures->map(function ($candidature) {
            return [
                'id' => $candidature->id,
                'notifications_by_phase' => $candidature->notifications_by_phase,
                'unread_notifications_count' => $candidature->unread_notifications_count
            ];
        })->toArray());

        function showNotificationsModal(phase, candidatureId) {
            const modal = document.getElementById('notificationsModal');
            const title = document.getElementById('modalTitle');
            const content = document.getElementById('notificationsContent');

            // Find the candidature data
            const candidature = notificationsData.find(c => c.id === candidatureId);
            if (!candidature) {
                content.innerHTML = '<p class="text-gray-600">Erreur : candidature non trouvée.</p>';
                modal.classList.remove('hidden');
                return;
            }

            // Set modal title based on phase
            const phaseTitles = {
                'selection': 'Notifications - Sélection',
                'entretien_rh': 'Notifications - Entretien RH',
                'test_technique': 'Notifications - Test Technique'
            };
            title.textContent = phaseTitles[phase] || 'Notifications';

            // Get notifications for the phase
            const notifications = candidature.notifications_by_phase[phase] || [];

            // Populate notifications
            if (notifications.length > 0) {
                content.innerHTML = notifications.map(notification => `
                    <div class="border-b py-2 ${notification.read ? 'text-gray-500' : 'text-gray-900 font-semibold'}">
                        <p>${notification.message}</p>
                        <p class="text-xs text-gray-400">${new Date(notification.created_at).toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                        ${!notification.read ? `<button onclick="markAsRead(${notification.id}, '${phase}', ${candidatureId})" class="text-blue-500 text-xs hover:underline">Marquer comme lu</button>` : ''}
                    </div>
                `).join('');
            } else {
                content.innerHTML = '<p class="text-gray-600">Aucune notification pour cette phase.</p>';
            }

            // Show the modal
            modal.classList.remove('hidden');
        }

        function closeNotificationsModal() {
            const modal = document.getElementById('notificationsModal');
            modal.classList.add('hidden');
            document.getElementById('notificationsContent').innerHTML = '';
        }

        function markAsRead(notificationId, phase, candidatureId) {
            const url = '{{ route("candidats.markAsRead", ":id") }}'.replace(':id', notificationId);

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh the modal content
                    showNotificationsModal(phase, candidatureId);
                    // Update the unread count in the table
                    const candidature = notificationsData.find(c => c.id === candidatureId);
                    if (candidature) {
                        candidature.unread_notifications_count[phase] = Math.max(0, candidature.unread_notifications_count[phase] - 1);
                        const button = document.querySelector(`button[onclick="showNotificationsModal('${phase}', ${candidatureId})"]`);
                        const countSpan = button.querySelector('.notification-badge');
                        if (countSpan) {
                            countSpan.textContent = candidature.unread_notifications_count[phase];
                            if (candidature.unread_notifications_count[phase] === 0) {
                                countSpan.remove();
                            }
                        }
                    }
                } else {
                    alert('Erreur lors de la mise à jour de la notification.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endpush
@endsection
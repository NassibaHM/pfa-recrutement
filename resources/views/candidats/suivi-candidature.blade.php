@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-bold mb-6">{{ __('Suivi de Ma Candidature') }}</h2>

                <!-- Candidature Progress Table -->
                @if ($candidatures->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poste</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sélection</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entretien RH</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test Technique</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($candidatures as $candidature)
                                    @php
                                        $selectionStatus = $candidature->statuses()->where('phase', 'selection')->latest()->first();
                                        $entretienRHStatus = $candidature->statuses()->where('phase', 'entretien_rh')->latest()->first();
                                        $testTechniqueStatus = $candidature->statuses()->where('phase', 'test_technique')->latest()->first();
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $candidature->offre->profile ?? 'Non défini' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span>{{ $selectionStatus ? $selectionStatus->status : 'En attente' }}</span>
                                            <div class="mt-2">
                                                <button onclick="showNotificationsModal('selection', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    📩
                                                    @if ($candidature->unread_notifications_count['selection'] > 0)
                                                        <span class="ml-1">{{ $candidature->unread_notifications_count['selection'] }}</span>
                                                    @endif
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span>{{ $entretienRHStatus ? $entretienRHStatus->status : 'En attente' }}</span>
                                            <div class="mt-2">
                                                <button onclick="showNotificationsModal('entretien_rh', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    📩
                                                    @if ($candidature->unread_notifications_count['entretien_rh'] > 0)
                                                        <span class="ml-1">{{ $candidature->unread_notifications_count['entretien_rh'] }}</span>
                                                    @endif
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span>{{ $testTechniqueStatus ? $testTechniqueStatus->status : 'En attente' }}</span>
                                            <div class="mt-2">
                                                <button onclick="showNotificationsModal('test_technique', {{ $candidature->id }})" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    📩
                                                    @if ($candidature->unread_notifications_count['test_technique'] > 0)
                                                        <span class="ml-1">{{ $candidature->unread_notifications_count['test_technique'] }}</span>
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
    </div>

    <!-- Notifications Modal -->
    <div id="notificationsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 max-h-[80vh] overflow-y-auto">
            <h3 id="modalTitle" class="text-lg font-semibold mb-4">Notifications</h3>
            <div id="notificationsContent" class="mb-4">
                <!-- Notifications will be populated dynamically -->
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="closeNotificationsModal()">Fermer</button>
            </div>
        </div>
    </div>

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
                        const countSpan = button.querySelector('span.ml-1');
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
@endsection
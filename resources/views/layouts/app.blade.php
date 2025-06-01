<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Shared Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulseGlow { 0% { box-shadow: 0 0 5px rgba(245, 158, 11, 0.4); } 50% { box-shadow: 0 0 20px rgba(245, 158, 11, 0.8); } 100% { box-shadow: 0 0 5px rgba(245, 158, 11, 0.4); } }
        @keyframes slideRight { from { transform: translateX(-100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes bellRing { 0% { transform: rotate(0); } 10% { transform: rotate(15deg); } 20% { transform: rotate(-15deg); } 30% { transform: rotate(10deg); } 40% { transform: rotate(-10deg); } 50% { transform: rotate(5deg); } 60% { transform: rotate(-5deg); } 70% { transform: rotate(0); } }
        @keyframes modalFadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

        .animate-fade-up { animation: fadeInUp 0.6s ease-out; }
        .animate-slide-right { animation: slideRight 0.5s ease-out; }
        .pulse-glow { animation: pulseGlow 2s infinite; }
        .bell-ring { animation: bellRing 1s ease-in-out; }
        .neon-yellow { color: #f59e0b; text-shadow: 0 0 5px rgba(245, 158, 11, 0.5); }

        /* Sidebar Styling */
        .sidebar-modern { background: linear-gradient(180deg, #1e40af 0%, #4b5e99 100%); color: #ffffff; }

        /* Card Styling */
        .card-modern {
            background: linear-gradient(145deg, rgba(30, 64, 175, 0.2), rgba(255, 255, 255, 0.8));
            border: 1px solid rgba(30, 64, 175, 0.3);
            transition: all 0.3s ease;
        }
        .card-modern:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(30, 64, 175, 0.2); }

        /* Button Styling */
        .nav-button { transition: all 0.3s ease; }
        .nav-button:hover { background-color: #1e3a8a !important; transform: scale(1.02); }
        .nav-button.active { background-color: rgba(245, 158, 11, 0.5) !important; }

        /* Input Styling */
        .input-modern {
            border: 1px solid rgba(30, 64, 175, 0.3);
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
            outline: none;
        }
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

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: #f59e0b;
            color: white;
            font-size: 0.65rem;
            font-weight: bold;
            border-radius: 9999px;
            padding: 2px 6px;
            min-width: 16px;
            text-align: center;
        }

        /* Icon Vibrant */
        .icon-vibrant {
            text-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
        @auth
            @php $role = Auth::user()->role; @endphp

            @if ($role === 'candidat')
                <!-- Candidat Layout -->
                <x-candidat-header />
                <div class="flex">
                    <x-candidat-sidebar />
                    <main class="flex-1 p-8">
                        @yield('content')
                    </main>
                </div>
                <x-notification-modal />
            @else
                <!-- Recruteur or Other Roles -->
                @yield('content')
            @endif
        @else
            <!-- Unauthenticated Users -->
            @yield('content')
        @endauth

        <!-- Notification Scripts for Candidat -->
        @auth
            @if (Auth::user()->role === 'candidat')
                @php
                    $notificationsData = Auth::check() ? Auth::user()->customNotifications()->get()->map(function ($notification) {
                        return [
                            'id' => $notification->id,
                            'message' => $notification->message,
                            'created_at' => $notification->created_at->toDateTimeString(),
                            'read' => $notification->read,
                            'phase' => $notification->phase,
                            'candidature_id' => $notification->candidature_id,
                        ];
                    })->values()->toArray() : [];
                @endphp

                <script>
                    const notificationsData = @json($notificationsData);

                    function showNotificationsModal() {
                        const modal = document.getElementById('notificationsModal');
                        const title = document.getElementById('modalTitle');
                        const content = document.getElementById('notificationsContent');

                        title.textContent = 'Notifications';

                        if (notificationsData.length > 0) {
                            content.innerHTML = notificationsData.map(notification => `
                                <div class="border-b py-2 ${notification.read ? 'text-gray-500' : 'text-gray-900 font-semibold'}">
                                    <p>${notification.message}</p>
                                    <p class="text-xs text-gray-400">${new Date(notification.created_at).toLocaleString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                                    ${!notification.read ? `<button onclick="markAsRead(${notification.id}, '${notification.phase}', ${notification.candidature_id})" class="text-blue-500 text-xs hover:underline">Marquer comme lu</button>` : ''}
                                </div>
                            `).join('');
                        } else {
                            content.innerHTML = '<p class="text-gray-600">Aucune notification.</p>';
                        }

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
                                showNotificationsModal();
                                const unreadCount = {{ Auth::check() ? Auth::user()->customNotifications()->where('read', false)->count() : 0 }};
                                const badge = document.querySelector('.notification-badge');
                                if (badge) {
                                    badge.textContent = unreadCount;
                                    if (unreadCount === 0) {
                                        badge.remove();
                                    }
                                } else if (unreadCount > 0) {
                                    const button = document.querySelector('button.bell-ring');
                                    button.innerHTML = '<i class="fas fa-bell text-[#0f172a]"></i><span class="notification-badge">' + unreadCount + '</span>';
                                }
                            } else {
                                alert('Erreur lors de la mise à jour de la notification.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                </script>
            @endif
        @endauth

        <script src="//unpkg.com/alpinejs" defer></script>
        @stack('scripts')
    </div>
</body>
</html>
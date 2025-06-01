@extends('layouts.app')

@section('content')
<style>
    /* Ensure @import is at the top */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

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

    @keyframes pulseGlow {
        0% {
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
        }
        50% {
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.8);
        }
        100% {
            box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
        }
    }

    @keyframes slideRight {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes bellRing {
        0% { transform: rotate(0); }
        10% { transform: rotate(15deg); }
        20% { transform: rotate(-15deg); }
        30% { transform: rotate(10deg); }
        40% { transform: rotate(-10deg); }
        50% { transform: rotate(5deg); }
        60% { transform: rotate(-5deg); }
        70% { transform: rotate(0); }
    }

    .animate-fade-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .animate-slide-right {
        animation: slideRight 0.5s ease-out;
    }

    .pulse-glow {
        animation: pulseGlow 2s infinite;
    }

    .bell-ring {
        animation: bellRing 1s ease-in-out;
    }

    .neon-yellow {
        color: #f59e0b;
        text-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
    }

    /* Sidebar Styling */
    .sidebar-modern {
        background: linear-gradient(180deg, #1e40af 0%, #4b5e99 100%);
        color: #ffffff;
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

    /* Input Styling */
    .input-field {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        transition: border-color 0.2s;
    }

    .input-field:focus {
        outline: none;
        border-color: #1e40af;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #1e40af;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #1e3a8a;
    }

    .nav-button {
        transition: all 0.3s ease;
    }

    .nav-button:hover {
        background-color: #1e3a8a !important;
        transform: scale(1.02);
    }

    .nav-button.active {
        background-color: rgba(245, 158, 11, 0.5) !important;
    }

    /* Vibrant Icon Styles */
    .icon-vibrant {
        text-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
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

    /* Error Message */
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 4px;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16">
                <div class="ml-auto flex items-center space-x-4">
                    <!-- Notification Icon -->
                    <div class="relative">
                        <button class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors bell-ring" onclick="showNotificationsModal()">
                            <i class="fas fa-bell text-[#0f172a]"></i>
                            @php
                                $unreadNotificationsCount = Auth::user()->notifications()->where('read', false)->count();
                            @endphp
                            @if($unreadNotificationsCount > 0)
                                <span class="notification-badge">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </button>
                    </div>
                    <!-- User Profile -->
                    <span class="text-sm text-gray-600">
                        Bienvenue, <strong>{{ Auth::user()->name }}</strong>
                    </span>
                    <div class="w-8 h-8 bg-gradient-to-r from-[#1e40af] to-[#0f172a] rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-72 min-h-screen sidebar-modern animate-slide-right">
            <div class="p-8">
                <!-- Logo Section -->
                <div class="mb-12">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center pulse-glow">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Recruit<span class="neon-yellow">AI</span></h1>
                            <p class="text-gray-200 text-sm">Intelligence Artificielle</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="space-y-3">
                    <div class="text-gray-200 text-xs font-semibold uppercase tracking-wider mb-6">Menu Candidat</div>
                    <a href="{{ route('candidat.welcome') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.welcome') ? 'active' : '' }}">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-home text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Accueil</div>
                            <div class="text-xs text-gray-200">Vue d'ensemble</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <a href="{{ route('candidat.offres') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.offres') ? 'active' : '' }}">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-search text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Offres</div>
                            <div class="text-xs text-gray-200">Explorer les opportunités</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <a href="{{ route('candidat.mes_postes') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.mes_postes') ? 'active' : '' }}">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-clipboard-list text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Mes Candidatures</div>
                            <div class="text-xs text-gray-200">Suivi des postes</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <a href="{{ route('candidat.suivi_candidature') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.suivi_candidature') ? 'active' : '' }}">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-hourglass-half text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Suivi Candidature</div>
                            <div class="text-xs text-gray-200">Statut des candidatures</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <a href="{{ route('candidat.profile') }}" 
                       class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30 {{ Route::is('candidat.profile') ? 'active' : '' }}">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Mon Profil</div>
                            <div class="text-xs text-gray-200">Gérer mes informations</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <a href="{{ route('logout') }}" 
                       class="group flex items-center p-4 rounded-xl bg-red-900/30 hover:bg-red-900/50 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium">Déconnexion</div>
                            <div class="text-xs text-gray-200">Se déconnecter</div>
                        </div>
                        <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
                <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
                    <i class="fas fa-user mr-2 text-[#f59e0b]"></i>Mon Profil
                </h1>
                <p class="text-gray-600 mb-6">Gérez vos informations personnelles.</p>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('candidat.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                               class="input-field @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}"
                               class="input-field @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                               class="input-field @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (facultatif)</label>
                        <input type="password" name="password" id="password"
                               class="input-field @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="input-field">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </main>
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

    <!-- Font Awesome 6.6.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

    @php
        $notificationsData = Auth::user()->notifications()->get()->map(function ($notification) {
            return [
                'id' => $notification->id,
                'message' => $notification->message,
                'created_at' => $notification->created_at->toDateTimeString(),
                'read' => $notification->read,
                'phase' => $notification->phase,
                'candidature_id' => $notification->candidature_id,
            ];
        })->values()->toArray();
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
                    const unreadCount = {{ Auth::user()->notifications()->where('read', false)->count() }};
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
</div>
@endsection
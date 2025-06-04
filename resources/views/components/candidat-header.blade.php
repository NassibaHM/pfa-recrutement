<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end items-center h-16">
            <div class="flex items-center space-x-4">
                <!-- Notification Icon -->
                <div class="relative">
                    <button class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors bell-ring" onclick="showNotificationsModal()">
                        <i class="fas fa-bell text-[#0f172a]"></i>
                        @if($unreadNotificationsCount > 0)
                            <span class="notification-badge">{{ $unreadNotificationsCount }}</span>
                        @endif
                    </button>
                </div>

                <!-- User Profile -->
               

                <div class="w-8 h-8 bg-gradient-to-r from-[#1e40af] to-[#0f172a] rounded-full flex items-center justify-center">
                    <span class="text-sm font-medium text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @auth
        @php $role = Auth::user()->role; @endphp

        @if ($role === 'candidat')
            <div class="min-h-screen bg-gray-100">
                @include('layouts.navigation')

                <div class="flex">
                    <!-- Sidebar candidat -->
                    <aside class="w-64 bg-gray-800 text-white min-h-screen px-4 py-6">
                        @include('components.sidebar_candidat')
                    </aside>

                    <!-- Contenu principal -->
                    <div class="flex-1">
                        @hasSection('header')
                            <header class="bg-white shadow">
                                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                    @yield('header')
                                </div>
                            </header>
                        @endif

                        <main class="p-6">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        @else
            {{-- Recruteur : afficher seulement le contenu sans sidebar ni fond gris --}}
            @yield('content')
        @endif
    @endauth

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>

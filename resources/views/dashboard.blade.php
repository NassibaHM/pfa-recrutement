@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Tableau de Bord</h2>
        </div>
    </x-slot>

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md p-5">
            <h3 class="text-xl font-semibold text-gray-700">Navigation</h3>
            <ul class="mt-4 space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">🏠 Accueil</a>
                </li>
                <li>
                    <a href="{{ route('criteres.index') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">💼 Offres</a>
                </li>
                <li>
                    <a href="{{ route('candidats.list') }}" class="block p-3 rounded-lg text-gray-800 hover:bg-gray-200">👤 Candidats</a>
                </li>
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
                <h3 class="text-2xl font-semibold text-gray-700">Bienvenue dans votre espace</h3>
                <p class="mt-2 text-gray-600">Vous êtes connecté en tant que <strong>{{ Auth::user()->name }}</strong>.</p>

                <div class="mt-6 grid grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-bold">Total Offres</h4>
                        <p class="text-2xl mt-2">12</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-bold">Candidats</h4>
                        <p class="text-2xl mt-2">35</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-bold">Critères définis</h4>
                        <p class="text-2xl mt-2">8</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
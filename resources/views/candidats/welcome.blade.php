@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">👋 Bienvenue, {{ $user->name }}</h1>
    <p class="text-gray-600">Accédez aux offres, suivez vos candidatures et explorez votre espace personnel.</p>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <a href="{{ route('candidat.offres') }}" class="bg-blue-500 text-white rounded-lg p-4 shadow hover:bg-blue-600">
            📄 Voir les offres disponibles
        </a>
        <a href="{{ route('candidat.mes_postes') }}" class="bg-green-500 text-white rounded-lg p-4 shadow hover:bg-green-600">
            📝 Mes candidatures
        </a>
    </div>
</div>
@endsection

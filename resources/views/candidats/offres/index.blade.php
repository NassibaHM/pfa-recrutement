@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📄 Offres disponibles</h1>

    @forelse ($offres as $offre)
        <div class="bg-white rounded-lg shadow p-6 mb-4">
            <h2 class="text-xl font-semibold mb-2 text-indigo-700">{{ $offre->profile }}</h2>
            <p class="text-gray-700 mb-3">{{ Str::limit($offre->description, 150) }}</p>
            <a href="{{ route('candidat.offres.show', $offre->id) }}" class="text-blue-500 hover:underline mr-4">Voir les détails</a>
            @if (Auth::check() && in_array($offre->id, $appliedOffreIds))
                <span class="text-gray-500 cursor-not-allowed">Déjà postulé</span>
            @else
                <a href="{{ route('candidature.create', $offre->id) }}" class="text-green-600 hover:underline">Postuler</a>
            @endif
        </div>
    @empty
        <p class="text-gray-600">Aucune offre disponible pour le moment.</p>
    @endforelse

    <div class="mt-4">
        {{ $offres->links() }}
    </div>
</div>
@endsection

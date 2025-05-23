@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">📄 Offres disponibles</h1>

    @foreach ($offres as $offre)
        <div class="bg-white rounded shadow p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $offre->profile }}</h2>
            <p class="text-gray-600">{{ Str::limit($offre->description, 150) }}</p>
            <a href="{{ route('candidat.offres.show', $offre->id) }}" class="text-blue-600 hover:underline">Voir plus</a>
        </div>
    @endforeach

    <div class="mt-4">
        {{ $offres->links() }}
    </div>
</div>
@endsection

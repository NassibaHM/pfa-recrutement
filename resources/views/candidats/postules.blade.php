<!-- resources/views/candidats/postules.blade.php -->
@extends('layouts.candidat')

@section('content')
<div class="p-10">
    <h2 class="text-2xl font-bold mb-4">📝 Vos Candidatures</h2>
    <ul class="space-y-4">
        @foreach($candidatures as $candidature)
            <li class="bg-white p-4 rounded shadow">
                <p><strong>Offre :</strong> {{ $candidature->offre->titre }}</p>
                <p><strong>Score :</strong> {{ $candidature->score }}</p>
                <p><strong>Status :</strong> {{ $candidature->statut ?? 'En attente' }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection

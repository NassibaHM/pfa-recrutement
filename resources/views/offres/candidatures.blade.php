@extends('layouts.app')

@section('content')
    <h2>Candidatures pour l'offre : {{ $offre->titre }}</h2>

    @if($candidatures->isEmpty())
        <p>Aucune candidature reçue pour le moment.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Score</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatures as $candidature)
                    <tr>
                        <td>{{ $candidature->nom }}</td>
                        <td>{{ $candidature->email }}</td>
                        <td>{{ $candidature->score }}</td>
                        <td><a href="{{ route('candidature.details', $candidature->id) }}">Voir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

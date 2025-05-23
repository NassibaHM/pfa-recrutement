@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Liste des Offres</h2>

    <a href="{{ route('offres.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une offre</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Titre</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offres as $offre)
            <tr>
                <td class="border px-4 py-2">{{ $offre->titre }}</td>
                <td class="border px-4 py-2">{{ $offre->description }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('offres.show', $offre) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('offres.edit', $offre) }}" class="text-yellow-500 mx-2">Modifier</a>
                    <form action="{{ route('offres.destroy', $offre) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Supprimer</button>
                    </form>

                    <!-- Ajouter la route pour voir les candidatures ici -->
                    <a href="{{ route('offres.candidatures', $offre->id) }}" class="text-blue-500 underline">
                        Voir les candidatures
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

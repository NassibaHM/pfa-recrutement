@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Liste des Candidats</h2>

    <a href="{{ route('candidats.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter un candidat</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Prénom</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidats as $candidat)
            <tr>
                <td class="border px-4 py-2">{{ $candidat->nom }}</td>
                <td class="border px-4 py-2">{{ $candidat->prenom }}</td>
                <td class="border px-4 py-2">{{ $candidat->email }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('candidats.show', $candidat) }}" class="text-blue-500">Voir</a>
                    <a href="{{ route('candidats.edit', $candidat) }}" class="text-yellow-500 mx-2">Modifier</a>
                    <form action="{{ route('candidats.destroy', $candidat) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

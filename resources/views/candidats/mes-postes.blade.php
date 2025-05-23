@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-bold mb-6">{{ __('Mes Candidatures') }}</h2>

                <table class="min-w-full border-collapse table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Poste</th>
                            <th class="px-4 py-2 border">Description</th>
                            <th class="px-4 py-2 border">Date sélection</th>
                            <th class="px-4 py-2 border">Date entretien</th>
                            <th class="px-4 py-2 border">Date test</th>
                            <th class="px-4 py-2 border">Lieu</th>
                            <th class="px-4 py-2 border">Pièces à fournir</th>
                            <th class="px-4 py-2 border">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidatures as $candidature)
                            @php
                                $critere = $candidature->offre->criteres;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 border">{{ $critere->profile ?? 'Non défini' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->description ?? 'Non défini' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->date_selection ?? 'Non définie' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->date_entretien ?? 'Non définie' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->date_test ?? 'Non définie' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->local_entretien ?? 'Non défini' }}</td>
                                <td class="px-4 py-2 border">{{ $critere->pieces_apporter ?? 'Non définies' }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('candidature.voirDetails', $candidature->id) }}" class="text-blue-600">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

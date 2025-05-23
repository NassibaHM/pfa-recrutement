@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Ajouter un Candidat</h2>

    <form action="{{ route('candidats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block mb-2">Nom :</label>
        <input type="text" name="nom" required class="border p-2 w-full">

        <label class="block mb-2">Prénom :</label>
        <input type="text" name="prenom" required class="border p-2 w-full">

        <label class="block mb-2">Email :</label>
        <input type="email" name="email" required class="border p-2 w-full">

        <label class="block mb-2">Téléphone :</label>
        <input type="text" name="telephone" class="border p-2 w-full">

        <label class="block mb-2">CV :</label>
        <input type="file" name="cv" class="border p-2 w-full">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4">Ajouter</button>
    </form>
</div>
@endsection

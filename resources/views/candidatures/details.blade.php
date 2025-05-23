@extends('layouts.app')

@section('content')
    <h2>Détails de la candidature</h2>
    <ul>
        <li><strong>Nom :</strong> {{ $candidature->nom }}</li>
        <li><strong>Email :</strong> {{ $candidature->email }}</li>
        <li><strong>Téléphone :</strong> {{ $candidature->telephone }}</li>
        <li><strong>Adresse :</strong> {{ $candidature->adresse }}</li>
        <li><strong>Date de naissance :</strong> {{ $candidature->date_naissance }}</li>
        <li><strong>Formation :</strong> {{ $candidature->formation }}</li>
        <li><strong>Expérience :</strong> {{ $candidature->experience }}</li>
        <li><strong>Compétences techniques :</strong> {{ $candidature->competences_techniques }}</li>
        <li><strong>Compétences linguistiques :</strong> {{ $candidature->competences_linguistiques }}</li>
        <li><strong>Compétences managériales :</strong> {{ $candidature->competences_manageriales }}</li>
        <li><strong>Certifications :</strong> {{ $candidature->certifications }}</li>
        <li><strong>Autres informations :</strong> {{ $candidature->autres_informations }}</li>
        
        <!-- ... -->
    </ul>
@endsection

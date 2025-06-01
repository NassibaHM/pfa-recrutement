@extends('layouts.app')

   @section('content')
       <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
           <h2 class="text-2xl font-bold text-[#0f172a] mb-6">
               <i class="fas fa-file-alt mr-2 text-[#f59e0b]"></i>Détails de la candidature
           </h2>

           @if($candidature)
               <dl class="details-list grid grid-cols-1 md:grid-cols-2 gap-4">
                   <div><dt>Nom :</dt><dd>{{ $candidature->nom ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Email :</dt><dd>{{ $candidature->email ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Téléphone :</dt><dd>{{ $candidature->telephone ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Adresse :</dt><dd>{{ $candidature->adresse ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Date de naissance :</dt><dd>{{ $candidature->date_naissance ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Formation :</dt><dd>{{ $candidature->formation ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Expérience :</dt><dd>{{ $candidature->experience ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Compétences techniques :</dt><dd>{{ $candidature->competences_techniques ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Compétences linguistiques :</dt><dd>{{ $candidature->competences_linguistiques ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Compétences managériales :</dt><dd>{{ $candidature->competences_manageriales ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Certifications :</dt><dd>{{ $candidature->certifications ?? 'Non spécifié' }}</dd></div>
                   <div><dt>Autres informations :</dt><dd>{{ $candidature->autres_informations ?? 'Non spécifié' }}</dd></div>
               </dl>
               <div class="mt-6">
                   <a href="{{ route('candidat.mes_postes') }}" 
                      class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition font-medium">
                       ← Retour
                   </a>
               </div>
           @else
               <p class="text-gray-600">Aucune candidature trouvée.</p>
           @endif
       </div>
   @endsection

   @push('styles')
       <style>
           .details-list dt {
               color: #1e40af;
               font-weight: 600;
           }

           .details-list dd {
               color: #374151;
               margin-bottom: 1rem;
           }
       </style>
   @endpush
@extends('layouts.app')

@section('content')
<style>
  /* Ensure @import is at the top */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

  * {
    font-family: 'Inter', sans-serif;
  }

  /* Animations */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes pulseGlow {
    0% {
      box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
    }
    50% {
      box-shadow: 0 0 20px rgba(245, 158, 11, 0.8);
    }
    100% {
      box-shadow: 0 0 5px rgba(245, 158, 11, 0.4);
    }
  }

  @keyframes slideRight {
    from {
      transform: translateX(-100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  .animate-fade-up {
    animation: fadeInUp 0.6s ease-out;
  }

  .animate-slide-right {
    animation: slideRight 0.5s ease-out;
}

  .pulse-glow {
    animation: pulseGlow 2s infinite;
  }

  .neon-yellow {
    color: #f59e0b;
    text-shadow: 0 0 5px rgba(245, 158, 11, 0.5);
  }

  /* Sidebar Styling */
  .sidebar-modern {
    background: linear-gradient(180deg, #1e40af 0%, #4b5e99 100%);
    color: #ffffff;
  }

  /* Card Styling */
  .card-modern {
    background: linear-gradient(145deg, rgba(30, 64, 175, 0.2), rgba(255, 255, 255, 0.8));
    border: 1px solid rgba(30, 145, 175, 0.3);
    transition: all 0.3s ease;
  }

  .card-modern:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(30, 64, 175, 0.2);
  }

  /* Button Styling */
  .nav-button {
    transition: all 0.3s ease;
  }

  .nav-button:hover {
    background-color: rgba(245, 158, 11, 0.3) !important;
    transform: scale(1.05);
  }

  .nav-button.active {
    background-color: rgba(245, 158, 11, 0.5) !important;
  }

  /* Table Styling */
  .table-modern th {
    background: #1e40af;
    color: #ffffff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
  }

  .table-modern tr:nth-child(even) {
    background: rgba(30, 64, 175, 0.05);
  }

  .table-modern tr:hover {
    background: rgba(245, 158, 11, 0.1);
  }

  .table-modern td, .table-modern th {
    border: 1px solid rgba(30, 64, 175, 0.2);
    padding: 10px;
    font-size: 0.875rem;
  }

  /* Input and Select Styling */
  .input-modern, select {
    border: 1px solid rgba(30, 64, 175, 0.3);
    background: #ffffff;
    transition: all 0.3s ease;
    border-radius: 8px;
  }

  .input-modern:focus, select:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    outline: none;
  }

  /* Modal Styling */
  .modal-content {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(30, 64, 175, 0.1));
    border: 1px solid rgba(30, 64, 175, 0.3);
  }
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
  <!-- Header -->
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center h-16">
        <div class="ml-auto flex items-center space-x-4">
          <span class="text-sm text-gray-600">
            Bienvenue, <strong>{{ Auth::user()->name }}</strong>
          </span>
          <div class="w-8 h-8 bg-gradient-to-r from-[#1e40af] to-[#0f172a] rounded-full flex items-center justify-center">
            <span class="text-sm font-medium text-white">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-72 min-h-screen sidebar-modern animate-slide-right">
      <div class="p-8">
        <!-- Logo Section -->
        <div class="mb-12">
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center pulse-glow">
              <i class="fas fa-brain text-white text-xl"></i>
            </div>
            <div>
              <h1 class="text-2xl font-bold text-white">Recruit<span class="neon-yellow">AI</span></h1>
              <p class="text-gray-200 text-sm">Intelligence Artificielle</p>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <nav class="space-y-3">
          <div class="text-gray-200 text-xs font-semibold uppercase tracking-wider mb-6">Menu Principal</div>
          <a href="{{ route('dashboard') }}" 
             class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
              <i class="fas fa-home text-white"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">Dashboard</div>
              <div class="text-xs text-gray-200">Vue d'ensemble</div>
            </div>
            <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </a>
          <a href="{{ route('criteres.index') }}" 
             class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
              <i class="fas fa-briefcase text-white"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">Offres</div>
              <div class="text-xs text-gray-200">Gestion des profils</div>
            </div>
            <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </a>
          <a href="{{ route('candidats.list') }}" 
             class="group flex items-center p-4 rounded-xl bg-[#667eea] bg-opacity-20 border border-white border-opacity-30 text-white transition-all hover:bg-opacity-30 hover:border-opacity-50">
            <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
              <i class="fas fa-users text-white"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">Candidats</div>
              <div class="text-xs text-gray-200">Base de données RH</div>
            </div>
            <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </a>
          <a href="{{ route('logout') }}" 
             class="group flex items-center p-4 rounded-xl bg-red-900/30 hover:bg-red-900/50 border border-white border-opacity-20 text-white transition-all hover:border-opacity-30" 
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
              <i class="fas fa-sign-out-alt text-white"></i>
            </div>
            <div class="flex-1">
              <div class="font-medium">Déconnexion</div>
              <div class="text-xs text-gray-200">Se déconnecter</div>
            </div>
            <i class="fas fa-chevron-right text-[#f59e0b] opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
        <h3 class="text-2xl font-bold text-[#0f172a] mb-6">Gestion des Candidats</h3>

        <!-- Filter by Offer -->
        <div class="mb-6">
          <label for="offre_id" class="block text-sm font-semibold text-[#0f172a] mb-2">Filtrer par offre :</label>
          <select name="offre_id" id="offre_id" 
                  onchange="window.location.href='{{ url('/candidats') }}/' + this.value" 
                  class="input-modern block w-full px-4 py-2 text-[#0f172a] rounded-lg">
            <option value="">Toutes les offres</option>
            @foreach ($offres as $offre)
              <option value="{{ $offre->id }}" {{ isset($offreId) && $offreId == $offre->id ? 'selected' : '' }}>{{ $offre->profile }}</option>
            @endforeach
          </select>
        </div>

        <!-- Rank Button -->
        @if (isset($offreId))
          @php
            $critere = $criteres->firstWhere('offre_id', $offreId);
          @endphp
          @if ($critere && !$candidatures->isEmpty())
            <div class="mb-6">
              <form method="POST" action="{{ route('critere.rank', ['critereId' => $critere->id]) }}">
                @csrf
                <button type="submit" 
                        class="nav-button px-4 py-2 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a]">
                  <i class="fas fa-sort-amount-up mr-2"></i>Classer Candidats
                </button>
              </form>
            </div>
          @elseif ($critere && $candidatures->isEmpty())
            <p class="text-gray-600 mb-6">Aucune candidature pour cette offre.</p>
          @else
            <p class="text-red-600 mb-6">
              Aucun critère défini pour cette offre. 
              <a href="{{ route('criteres.create') }}" class="text-[#1e40af] hover:underline">Ajouter un critère</a>.
            </p>
          @endif
        @endif

        <!-- Candidates List -->
        @if ($candidatures->isEmpty())
          <p class="text-gray-600">Aucun candidat pour cette offre.</p>
        @else
          <div class="overflow-x-auto">
            <table class="w-full table-modern">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Score</th>
                  <th>Rang</th>
                  <th>Sélection</th>
                  <th>Entretien RH</th>
                  <th>Test Technique</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($candidatures as $candidature)
                  @php
                    $selectionStatus = $candidature->statuses()->where('phase', 'selection')->latest()->first();
                    $entretienRHStatus = $candidature->statuses()->where('phase', 'entretien_rh')->latest()->first();
                    $testTechniqueStatus = $candidature->statuses()->where('phase', 'test_technique')->latest()->first();
                    $disableEntretienRH = $selectionStatus && $selectionStatus->status === 'non retenu';
                    $disableTestTechnique = $entretienRHStatus && $entretienRHStatus->status === 'non retenu';
                  @endphp
                  <tr>
                    <td>{{ $candidature->user->name }}</td>
                    <td>{{ $candidature->user->email }}</td>
                    <td>{{ $candidature->score_pertinence ? number_format($candidature->score_pertinence, 2).'%' : 'Non classé' }}</td>
                    <td>{{ $candidature->rank ?? 'Non classé' }}</td>
                    <td>
                      <select name="status_{{ $candidature->id }}_selection" 
                              onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'selection', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')"
                              class="input-modern px-3 py-1 text-[#0f172a] w-full">
                        <option value="en attente" {{ !$selectionStatus ? 'selected' : '' }}>En attente</option>
                        <option value="retenu" {{ $selectionStatus && $selectionStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                        <option value="non retenu" {{ $selectionStatus && $selectionStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                      </select>
                      <input type="checkbox" 
                             name="retained_{{ $candidature->id }}_selection" 
                             {{ $selectionStatus && $selectionStatus->retained ? 'checked' : '' }} 
                             onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_selection\"]').value, 'selection', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)"
                             class="mt-2">
                    </td>
                    <td>
                      <select name="status_{{ $candidature->id }}_entretien_rh" 
                              onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'entretien_rh', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')"
                              class="input-modern px-3 py-1 text-[#0f172a] w-full" 
                              {{ $disableEntretienRH ? 'disabled' : '' }}>
                        <option value="en attente" {{ !$entretienRHStatus ? 'selected' : '' }}>En attente</option>
                        <option value="retenu" {{ $entretienRHStatus && $entretienRHStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                        <option value="non retenu" {{ $entretienRHStatus && $entretienRHStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                      </select>
                      <input type="checkbox" 
                             name="retained_{{ $candidature->id }}_entretien_rh" 
                             {{ $entretienRHStatus && $entretienRHStatus->retained ? 'checked' : '' }} 
                             onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_entretien_rh\"]').value, 'entretien_rh', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)"
                             class="mt-2" {{ $disableEntretienRH ? 'disabled' : '' }}>
                    </td>
                    <td>
                      <select name="status_{{ $candidature->id }}_test_technique" 
                              onchange="updateStatusAndShowModal({{ $candidature->id }}, this.value, 'test_technique', '{{ route('candidats.updateStatus', $candidature->id) }}', this.value === 'retenu')"
                              class="input-modern px-3 py-1 text-[#0f172a] w-full" 
                              {{ $disableTestTechnique ? 'disabled' : '' }}>
                        <option value="en attente" {{ !$testTechniqueStatus ? 'selected' : '' }}>En attente</option>
                        <option value="retenu" {{ $testTechniqueStatus && $testTechniqueStatus->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                        <option value="non retenu" {{ $testTechniqueStatus && $testTechniqueStatus->status === 'non retenu' ? 'selected' : '' }}>Non Retenu</option>
                      </select>
                      <input type="checkbox" 
                             name="retained_{{ $candidature->id }}_test_technique" 
                             {{ $testTechniqueStatus && $testTechniqueStatus->retained ? 'checked' : '' }} 
                             onchange="updateStatusAndShowModal({{ $candidature->id }}, document.querySelector('select[name=\"status_{{ $candidature->id }}_test_technique\"]').value, 'test_technique', '{{ route('candidats.updateStatus', $candidature->id) }}', this.checked)"
                             class="mt-2" {{ $disableTestTechnique ? 'disabled' : '' }}>
                    </td>
                    <td>
                      <button type="button" 
                              class="nav-button px-3 py-1 bg-[#1e40af] text-white rounded-lg hover:bg-[#1e3a8a] border border-[#1e40af]"
                              onclick="viewCandidateDetails({{ $candidature->id }})">
                        <i class="fas fa-eye mr-2"></i>Voir Détails
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        <!-- Buttons -->
        <div class="mt-6 flex justify-between">
          <a href="{{ route('dashboard') }}"
             class="nav-button px-5 py-2 bg-[#666] text-white rounded-lg hover:bg-[#555]">
            <i class="fas fa-arrow-left mr-2"></i>Retour
          </a>
        </div>
      </div>
    </main>
  </div>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content p-6 rounded-xl shadow-lg w-full max-w-2xl">
      <h3 class="text-lg font-semibold text-[#0f172a] mb-4">Détails du Candidat</h3>
      <div id="modalContent" class="space-y-4 text-[#333]">
        <!-- Candidate details will be loaded here via AJAX -->
      </div>
      <div class="flex justify-end mt-6">
        <button type="button" 
                class="nav-button px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                onclick="closeModal()">
          <i class="fas fa-times mr-2"></i>Fermer
        </button>
      </div>
    </div>
  </div>

  <!-- Font Awesome 6.6.0 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

  <script>
    let currentCandidatureId = null;
    let currentPhase = null;

    function updateStatusAndHideModal(candidatureId, status, phase, url, retained) {
      currentCandidatureId = candidatureId;
      currentPhase = phase;
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content || ''
        },
        body: JSON.stringify({
          status,
          phase,
          retained
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Statut mis à jour avec succès.');
          location.reload();
        } else {
          alert('Erreur lors de la mise à jour: ' + (data.message || ''));
        }
      })
      .catch(error => console.error('Fetch error:', error));
    }

    function viewCandidateDetails(candidatureId) {
      const url = '{{ route("candidats.details", ":id") }}'.replace(':id', candidatureId);
      fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content || ''
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const photoUrl = data.candidature.photo ? '{{ url('') }}/storage/' + data.candidature.photo : null;
          const content = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
              <div class="flex items-center space-x-4">
                <div>
                  <strong>Photo :</strong><br>
                  ${photoUrl ? `<img src="${photoUrl}" alt="Photo du cadre" class="w-24 h-24 rounded-full object-cover" onerror="this.parentElement.innerHTML='<span>Aucune photo disponible</span>'">` : '<span>Aucune photo disponible</span>'}
                </div>
                <div>
                  <strong>Nom :</strong> ${data.candidature.nom || 'Non spécifié'}
                </div>
              </div>
              <div><strong>Email :</strong> ${data.candidature.email || 'Non spécifié'}</div>
              <div><strong>Contact :</strong> ${data.candidature.telephone || 'Non spécifié'}</div>
              <div><strong>Adresse :</strong> ${data.candidature.adresse || 'Non spécifié'}</div>
              <div><strong>Date de naissance :</strong> ${data.candidature.date_naissance || 'Non spécifié'}</div>
              <div><strong>Formation :</strong> ${data.candidature.formation || 'Non spécifié'}</div>
              <div><strong>Expérience :</strong> ${data.candidature.experience || 'Non spécifié'}</div>
              <div><strong>Compétences Techniques :</strong> ${data.candidature.competences_techniques || 'Non spécifié'}</div>
              <div><strong>Compétences Linguistiques :</strong> ${data.candidature.competences_linguistiques || 'Non spécifié'}</div>
              <div><strong>Services Managés :</strong> ${data.candidature.competences_manageriales || 'Non spécifié'}</div>
              <div><strong>Certifications :</strong> ${data.candidature.certifications || 'Non spécifié'}</div>
              <div class="md:col-span-2"><strong>Autres informations :</strong> ${data.candidature.autres_informations || 'Non spécifié'}</div>
            </div>
          `;
          document.getElementById('modalContent').innerHTML = content;
          document.getElementById('modal').classList.remove('hidden');
        } else {
          alert('Erreur : ' + (data.message || ''));
        }
      })
      .catch(error => console.error('Error:', error));
    }

    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
      document.getElementById('modalContent').innerHTML = '';
    }
  </script>
@endsection
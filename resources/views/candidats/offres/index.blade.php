@extends('layouts.app')

@section('content')
<style>
    /* Ensure @import is at the top */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    /* ... (styles unchanged) ... */
</style>

<div class="min-h-screen bg-gradient-to-br from-[#0f172a]/10 via-gray-50 to-[#1e40af]/10">
    <!-- Header -->
   

    <div class="flex">
  

        <main class="flex-1 p-8">
            <div class="card-modern rounded-xl shadow-sm p-6 animate-fade-up">
                <h1 class="text-2xl font-bold text-[#0f172a] mb-4">
                    <i class="fas fa-file-alt mr-2 text-[#f59e0b]"></i>Offres disponibles
                </h1>
                <p class="text-gray-600 mb-6">Explorez les opportunités de carrière disponibles.</p>

                @forelse ($offres as $offre)
                    <div class="card-modern rounded-lg p-6 mb-4">
                        <h2 class="text-xl font-semibold mb-2 text-[#1e40af]">{{ $offre->profile }}</h2>
                        <p class="text-gray-700 mb-3">{{ Str::limit($offre->description, 150) }}</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('candidat.offres.show', $offre->id) }}" 
                               class="text-blue-500 hover:underline font-medium">Voir les détails</a>
                            @if (Auth::check() && in_array($offre->id, $appliedOffreIds))
                                <span class="text-gray-500 cursor-not-allowed">Déjà postulé</span>
                            @else
                                <a href="{{ route('candidature.create', $offre->id) }}" 
                                   class="text-green-600 hover:underline font-medium">Postuler</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Aucune offre disponible pour le moment.</p>
                @endforelse

                <div class="mt-4">
                    {{ $offres->links() }}
                </div>
            </div>
        </main>
    </div>

    <div id="notificationsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 max-h-[80vh] overflow-y-auto">
            <h3 id="modalTitle" class="text-lg font-semibold mb-4">Notifications</h3>
            <div id="notificationsContent" class="mb-4"></div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="closeNotificationsModal()">Fermer</button>
            </div>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

    @php
        $notificationsData = [];
        try {
            $notificationsData = Auth::user()->notifications()->get()->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->message,
                    'created_at' => $notification->created_at->toDateTimeString(),
                    'read' => $notification->read,
                    'phase' => $notification->phase,
                    'candidature_id' => $notification->candidature_id,
                ];
            })->values()->toArray();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to load notifications data.', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);
        }
    @endphp

    <script>
        const notificationsData = @json($notificationsData);
        // ... (JavaScript unchanged) ...
    </script>
</div>
@endsection

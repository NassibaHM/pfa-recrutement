<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Candidature;
use App\Models\Notification;
use App\Models\CandidatureStatus;
use App\Models\Critere;
use App\Notifications\CandidatureStatusNotification;
use Illuminate\Http\Request;

class CandidatController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:recruteur')->only(['indexRecruteur', 'updateStatus', 'sendResponse', 'deleteNotification']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'candidat') {
            abort(403, 'Accès réservé aux candidats.');
        }

        return view('candidats.welcome', compact('user'));
    }

    public function mesPostes()
    {
        $candidatures = Candidature::where('user_id', Auth::id())->with('offre')->get();
        $notifications = Notification::where('user_id', Auth::id())->where('read', false)->get();

        return view('candidats.mes-postes', compact('candidatures', 'notifications'));
    }

    public function welcome()
    {
        $user = Auth::user();
        return view('candidats.welcome', compact('user'));
    }

    public function suiviCandidature()
    {
        $user = Auth::user();
        $candidatures = Candidature::where('user_id', $user->id)->with(['offre', 'statuses'])->get();

        Log::info('Suivi Candidature - User ID', ['user_id' => $user->id, 'timestamp' => now()]);
        Log::info('Suivi Candidature - Candidatures retrieved', ['candidatures_count' => $candidatures->count()]);

        foreach ($candidatures as $candidature) {
            Log::info('Processing candidature', ['candidature_id' => $candidature->id, 'user_id' => $user->id]);

            $candidature->notifications_by_phase = [
                'selection' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'selection')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'entretien_rh' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'entretien_rh')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'test_technique' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'test_technique')
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ];

            Log::info('Notifications retrieved for candidature', [
                'candidature_id' => $candidature->id,
                'selection_count' => $candidature->notifications_by_phase['selection']->count(),
                'entretien_rh_count' => $candidature->notifications_by_phase['entretien_rh']->count(),
                'test_technique_count' => $candidature->notifications_by_phase['test_technique']->count(),
                'sample_selection' => $candidature->notifications_by_phase['selection']->map(function ($n) { return ['id' => $n->id, 'message' => $n->message, 'user_id' => $n->user_id]; })->toArray(),
            ]);

            $candidature->unread_notifications_count = [
                'selection' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'selection')
                    ->where('read', false)
                    ->count(),
                'entretien_rh' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'entretien_rh')
                    ->where('read', false)
                    ->count(),
                'test_technique' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $user->id)
                    ->where('phase', 'test_technique')
                    ->where('read', false)
                    ->count(),
            ];

            Log::info('Unread notifications count for candidature', [
                'candidature_id' => $candidature->id,
                'unread_selection' => $candidature->unread_notifications_count['selection'],
                'unread_entretien_rh' => $candidature->unread_notifications_count['entretien_rh'],
                'unread_test_technique' => $candidature->unread_notifications_count['test_technique'],
            ]);
        }

        $notifications = Notification::where('user_id', $user->id)->where('read', false)->get();
        Log::info('Total unread notifications for user', ['user_id' => $user->id, 'count' => $notifications->count(), 'timestamp' => now()]);

        return view('candidats.suivi-candidature', compact('candidatures', 'notifications'));
    }

    public function indexRecruteur($offreId = null)
    {
        $user = Auth::user();

        if ($user->role !== 'recruteur') {
            abort(403, 'Accès réservé aux recruteurs.');
        }

        $candidatures = $offreId 
            ? Candidature::where('offre_id', $offreId)->with(['user', 'statuses'])->get()
            : Candidature::with(['user', 'offre', 'statuses'])->get();

        foreach ($candidatures as $candidature) {
            $candidature->unread_notifications_count = Notification::where('candidature_id', $candidature->id)
                ->where('user_id', $candidature->user_id)
                ->where('read', false)
                ->count();
            $candidature->notifications_by_phase = [
                'selection' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $candidature->user_id)
                    ->where('phase', 'selection')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'entretien_rh' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $candidature->user_id)
                    ->where('phase', 'entretien_rh')
                    ->orderBy('created_at', 'desc')
                    ->get(),
                'test_technique' => Notification::where('candidature_id', $candidature->id)
                    ->where('user_id', $candidature->user_id)
                    ->where('phase', 'test_technique')
                    ->orderBy('created_at', 'desc')
                    ->get(),
            ];
        }

        $offres = \App\Models\Offre::all();

        return view('candidats.index-recruteur', compact('candidatures', 'offres', 'offreId'));
    }

    public function updateStatus(Request $request, $candidatureId)
    {
        Log::info('Received updateStatus request', ['data' => $request->all(), 'timestamp' => now()]);
        $candidature = Candidature::findOrFail($candidatureId);
        $status = $request->input('status');
        $phase = $request->input('phase');
        $retained = $request->input('retained', false);
        $retained = filter_var($retained, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?: false;

        Log::info('Processed values', ['status' => $status, 'phase' => $phase, 'retained' => $retained, 'candidature_user_id' => $candidature->user_id, 'timestamp' => now()]);

        $validPhases = ['selection', 'entretien_rh', 'test_technique'];
        if (!in_array($phase, $validPhases)) {
            return response()->json(['success' => false, 'message' => 'Phase invalide'], 400);
        }

        try {
            $statusValue = $status;
            $retained = ($status === 'retenu');
            $existingStatus = CandidatureStatus::where('candidature_id', $candidatureId)
                ->where('phase', $phase)
                ->first();

            // Check if status is changing
            $previousStatus = $existingStatus ? $existingStatus->status : null;
            $statusChanged = $previousStatus !== $statusValue;

            $statusRecord = CandidatureStatus::updateOrCreate(
                ['candidature_id' => $candidatureId, 'phase' => $phase],
                ['status' => $statusValue, 'retained' => $retained]
            );
            Log::info('Saved to candidature_statuses (current phase)', $statusRecord->toArray());

            // Update subsequent phases if status is 'non retenu'
            if ($status === 'non retenu') {
                if ($phase === 'selection') {
                    $entretienRH = CandidatureStatus::firstOrCreate(
                        ['candidature_id' => $candidatureId, 'phase' => 'entretien_rh'],
                        ['status' => 'non retenu', 'retained' => false]
                    );
                    $entretienRH->update(['status' => 'non retenu', 'retained' => false]);
                    Log::info('Updated to candidature_statuses (next phase: entretien_rh)', ['status' => 'non retenu']);

                    $testTechnique = CandidatureStatus::firstOrCreate(
                        ['candidature_id' => $candidatureId, 'phase' => 'test_technique'],
                        ['status' => 'non retenu', 'retained' => false]
                    );
                    $testTechnique->update(['status' => 'non retenu', 'retained' => false]);
                    Log::info('Updated to candidature_statuses (next phase: test_technique)', ['status' => 'non retenu']);

                    // Delete notifications for subsequent phases
                    Notification::where('candidature_id', $candidatureId)
                        ->where('user_id', $candidature->user_id)
                        ->whereIn('phase', ['entretien_rh', 'test_technique'])
                        ->delete();
                    Log::info('Deleted notifications for subsequent phases', ['candidature_id' => $candidatureId, 'phases' => ['entretien_rh', 'test_technique']]);
                } elseif ($phase === 'entretien_rh') {
                    $testTechnique = CandidatureStatus::firstOrCreate(
                        ['candidature_id' => $candidatureId, 'phase' => 'test_technique'],
                        ['status' => 'non retenu', 'retained' => false]
                    );
                    $testTechnique->update(['status' => 'non retenu', 'retained' => false]);
                    Log::info('Updated to candidature_statuses (next phase: test_technique)', ['status' => 'non retenu']);

                    // Delete notifications for test_technique
                    Notification::where('candidature_id', $candidatureId)
                        ->where('user_id', $candidature->user_id)
                        ->where('phase', 'test_technique')
                        ->delete();
                    Log::info('Deleted notifications for phase', ['candidature_id' => $candidatureId, 'phase' => 'test_technique']);
                }
            }

            $user = $candidature->user;
            $offre = $candidature->offre;
            $critere = Critere::where('offre_id', $offre->id)->first();
            $local = $critere ? $critere->local_entretien : 'Non spécifié';
            $heure = $critere ? $critere->date_entretien : 'À préciser';
            $documents = $critere ? $critere->pieces_apporter : 'Aucun document spécifié';
            $heureTest = $critere ? $critere->date_test : 'À préciser';

            // If status changed, delete existing notifications for this phase
            if ($statusChanged) {
                Notification::where('candidature_id', $candidatureId)
                    ->where('user_id', $user->id)
                    ->where('phase', $phase)
                    ->delete();
                Log::info('Deleted existing notifications for phase', ['candidature_id' => $candidatureId, 'phase' => $phase]);
            }

            // Check for existing notification to avoid duplicates
            $existingNotification = Notification::where('candidature_id', $candidatureId)
                ->where('user_id', $user->id)
                ->where('phase', $phase)
                ->where('message', 'LIKE', "%$status%")
                ->first();

            $message = '';
            if ($status === 'retenu') {
                if ($phase === 'selection') {
                    $message = "Bonjour {$user->name},\nVous avez été sélectionné(e) pour passer un entretien RH pour le poste de {$offre->profile}. \nMerci d’apporter les documents suivants : {$documents}.\nL’entretien aura lieu le {$heure} au {$local}.";
                } elseif ($phase === 'entretien_rh') {
                    $message = "Félicitations {$user->name} !\nVous avez été retenu(e) à l’entretien RH pour le poste de {$offre->profile}.\nVous êtes invité(e) à passer le test technique le {$heureTest} au {$local}.";
                } elseif ($phase === 'test_technique') {
                    $message = "Félicitations {$user->name} !\nVous avez réussi toutes les étapes du processus. Vous êtes officiellement retenu(e) pour le poste de {$offre->profile}.\nNous vous contacterons bientôt pour finaliser les formalités d’embauche.";
                }
            } elseif ($status === 'non retenu') {
                if ($phase === 'selection') {
                    $message = "Bonjour {$user->name},\nNous vous remercions pour votre candidature au poste de {$offre->profile}, mais nous vous informons que vous n’avez pas été retenu(e) à cette étape du processus.";
                } elseif ($phase === 'entretien_rh') {
                    $message = "Bonjour {$user->name},\nSuite à l’entretien RH pour le poste de {$offre->profile}, nous vous informons que vous n’avez pas été retenu(e) pour la suite du processus.";
                } elseif ($phase === 'test_technique') {
                    $message = "Bonjour {$user->name},\nSuite à l’évaluation technique pour le poste de {$offre->profile}, nous vous informons que vous n’avez pas été retenu(e) pour ce poste.";
                }
            }

            if ($message && !$existingNotification && $statusChanged) {
                Log::info('Sending automatic notification to user', ['user_id' => $user->id, 'candidature_id' => $candidatureId, 'message' => $message, 'phase' => $phase, 'timestamp' => now()]);
                $notification = new CandidatureStatusNotification($message, $candidatureId, $phase);
                $notification->storeNotification($user);
                Log::info('Notification stored successfully for phase: ' . $phase, ['user_id' => $user->id, 'candidature_id' => $candidatureId, 'timestamp' => now()]);
            } else {
                Log::warning('No notification created', [
                    'reason' => $existingNotification ? 'Notification already exists' : ($statusChanged ? 'No message generated' : 'Status unchanged'),
                    'status' => $status,
                    'phase' => $phase,
                    'timestamp' => now()
                ]);
            }

            $allStatuses = CandidatureStatus::where('candidature_id', $candidatureId)
                ->pluck('status', 'phase')
                ->all();
            $etat = 'en attente';
            if (isset($allStatuses['selection']) && $allStatuses['selection'] === 'non retenu') {
                $etat = 'non retenu';
            } elseif (isset($allStatuses['test_technique']) && $allStatuses['test_technique'] === 'retenu') {
                $etat = 'retenu';
            } elseif (isset($allStatuses['entretien_rh']) && $allStatuses['entretien_rh'] === 'non retenu') {
                $etat = 'non retenu';
            } elseif (isset($allStatuses['selection']) && $allStatuses['selection'] === 'retenu') {
                $etat = 'retenu';
            }
            $candidature->update(['etat' => $etat, 'retained' => $this->isFullyRetained($candidatureId)]);
            Log::info('Updated candidature (etat recalculated)', $candidature->toArray());

            return response()->json(['success' => true, 'message' => 'Statut mis à jour avec succès.', 'autoMessage' => $message]);
        } catch (\Exception $e) {
            Log::error('Failed to save to candidature_statuses or notification', [
                'error' => $e->getMessage(),
                'candidature_id' => $candidatureId,
                'phase' => $phase,
                'status' => $statusValue,
                'retained' => $retained,
                'timestamp' => now()
            ]);
            return response()->json(['success' => false, 'message' => 'Erreur lors de la sauvegarde: ' . $e->getMessage()], 500);
        }
    }

    protected function isFullyRetained($candidatureId)
    {
        $statuses = CandidatureStatus::where('candidature_id', $candidatureId)
            ->pluck('retained', 'phase')
            ->all();
        return isset($statuses['selection']) && $statuses['selection'] &&
               isset($statuses['entretien_rh']) && $statuses['entretien_rh'] &&
               isset($statuses['test_technique']) && $statuses['test_technique'];
    }

    public function sendResponse(Request $request)
    {
        $request->validate([
            'candidatureId' => 'required|exists:candidatures,id',
            'message' => 'required|string|max:1000',
            'phase' => 'required|in:selection,entretien_rh,test_technique',
        ]);

        $candidature = Candidature::findOrFail($request->candidatureId);
        $user = $candidature->user;

        // Check for existing notification with the same message and phase
        $existingNotification = Notification::where('candidature_id', $candidature->id)
            ->where('user_id', $user->id)
            ->where('phase', $request->phase)
            ->where('message', $request->message)
            ->first();

        if (!$existingNotification) {
            $notification = new CandidatureStatusNotification($request->message, $candidature->id, $request->phase);
            $notification->storeNotification($user);
            Log::info('Custom notification sent', [
                'user_id' => $user->id,
                'candidature_id' => $candidature->id,
                'phase' => $request->phase,
                'message' => $request->message,
                'timestamp' => now()
            ]);
        } else {
            Log::warning('Duplicate custom notification prevented', [
                'user_id' => $user->id,
                'candidature_id' => $candidature->id,
                'phase' => $request->phase,
                'message' => $request->message,
                'timestamp' => now()
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->user_id === Auth::id()) {
            $notification->update(['read' => true]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 403);
    }

    public function deleteNotification(Request $request, $id)
{
    try {
        $user = Auth::user();
        if ($user->role !== 'recruteur') {
            Log::warning('Unauthorized attempt to delete notification', [
                'user_id' => $user->id,
                'notification_id' => $id,
                'timestamp' => now()
            ]);
            return response()->json(['success' => false, 'message' => 'Accès réservé aux recruteurs.'], 403);
        }

        $notification = Notification::find($id);
        if (!$notification) {
            Log::error('Notification not found', [
                'notification_id' => $id,
                'user_id' => $user->id,
                'timestamp' => now()
            ]);
            return response()->json(['success' => false, 'message' => 'Notification non trouvée.'], 404);
        }

        $candidature = Candidature::find($notification->candidature_id);
        if (!$candidature) {
            Log::error('Candidature not found for notification', [
                'notification_id' => $id,
                'candidature_id' => $notification->candidature_id,
                'user_id' => $user->id,
                'timestamp' => now()
            ]);
            return response()->json(['success' => false, 'message' => 'Candidature associée non trouvée.'], 404);
        }

        $notification->delete();
        Log::info('Notification deleted by recruiter', [
            'notification_id' => $id,
            'candidature_id' => $notification->candidature_id,
            'user_id' => $user->id,
            'timestamp' => now()
        ]);

        return response()->json(['success' => true, 'message' => 'Notification supprimée avec succès.']);
    } catch (\Exception $e) {
        Log::error('Failed to delete notification', [
            'notification_id' => $id,
            'user_id' => $user->id,
            'error' => $e->getMessage(),
            'timestamp' => now()
        ]);
        return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression: ' . $e->getMessage()], 500);
    }
}
}
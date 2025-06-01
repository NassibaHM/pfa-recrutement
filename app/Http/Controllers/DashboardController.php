<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Offre;
use App\Models\Candidature;
use App\Models\Critere;
use App\Models\CandidatureStatus;
use App\Models\Notification;
use App\Models\User; // Explicitly import User model
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Debugging: Check the user object and its class
        if (!$user) {
            Log::error('User is null in DashboardController@index');
            return redirect()->route('login')->with('error', 'Utilisateur non authentifié.');
        }

        Log::info('User class in DashboardController@index', [
            'class' => get_class($user),
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        // Redirection basée sur le rôle
        return match ($user->role) {
            'recruteur' => $this->dashboardRecruteur(),
            'candidat' => $this->dashboardCandidat(),
            default => abort(403, 'Accès non autorisé')
        };
    }

    protected function dashboardRecruteur()
    {
        // Logique existante pour les recruteurs...
        $offres_actives = Offre::where('statut', 'active')->count();

        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $offres_this_month = Offre::where('statut', 'active')
            ->where('created_at', '>=', $thisMonth)
            ->count();
        $offres_last_month = Offre::where('statut', 'active')
            ->where('created_at', '>=', $lastMonth)
            ->where('created_at', '<', $thisMonth)
            ->count();
        $evolution_offres = $offres_last_month > 0
            ? round((($offres_this_month - $offres_last_month) / $offres_last_month) * 100, 1)
            : ($offres_this_month > 0 ? 100 : 0);
        $evolution_offres = ($evolution_offres >= 0 ? '+' : '') . $evolution_offres . '%';

        $total_candidatures = Candidature::count();

        $candidatures_this_month = Candidature::where('created_at', '>=', $thisMonth)->count();
        $candidatures_last_month = Candidature::where('created_at', '>=', $lastMonth)
            ->where('created_at', '<', $thisMonth)
            ->count();
        $evolution_candidatures = $candidatures_last_month > 0
            ? round((($candidatures_this_month - $candidatures_last_month) / $candidatures_last_month) * 100, 1)
            : ($candidatures_this_month > 0 ? 100 : 0);
        $evolution_candidatures = ($evolution_candidatures >= 0 ? '+' : '') . $evolution_candidatures . '%';

        $startOfWeek = Carbon::now()->startOfWeek();
        $entretiens_planifies = CandidatureStatus::where('phase', 'entretien_rh')
            ->where('status', 'retenu')
            ->where('created_at', '>=', $startOfWeek)
            ->count();

        $candidatures_retenues = CandidatureStatus::where('phase', 'test_technique')
            ->where('status', 'retenu')
            ->count();
        $taux_reussite = $total_candidatures > 0
            ? round(($candidatures_retenues / $total_candidatures) * 100, 1)
            : 0;

        $stats = [
            'offres_actives' => $offres_actives,
            'evolution_offres' => $evolution_offres,
            'total_candidatures' => $total_candidatures,
            'evolution_candidatures' => $evolution_candidatures,
            'entretiens_planifies' => $entretiens_planifies,
            'taux_reussite' => $taux_reussite,
        ];

        return view('dashboard', compact('stats'));
    }

    protected function dashboardCandidat()
    {
        $user = Auth::user();

        // Debugging: Check the user object and its class
        if (!$user) {
            Log::error('User is null in DashboardController@dashboardCandidat');
            return redirect()->route('login')->with('error', 'Utilisateur non authentifié.');
        }

        // Forcer le rechargement du modèle pour s'assurer que c'est bien App\Models\User
        $user = User::find($user->id);

        if (!$user) {
            Log::error('User could not be reloaded in DashboardController@dashboardCandidat');
            return redirect()->route('login')->with('error', 'Utilisateur non trouvé.');
        }

        Log::info('User class in DashboardController@dashboardCandidat', [
            'class' => get_class($user),
            'user_id' => $user->id,
            'role' => $user->role,
        ]);

        // Vérifier si les méthodes existent
        if (!method_exists($user, 'notifications')) {
            Log::error('Method notifications does not exist on User', ['user_id' => $user->id]);
            throw new \Exception('Method notifications does not exist on User');
        }
        if (!method_exists($user, 'candidatures')) {
            Log::error('Method candidatures does not exist on User', ['user_id' => $user->id]);
            throw new \Exception('Method candidatures does not exist on User');
        }

        // Calculer le nombre de notifications non lues
        $unreadNotificationsCount = $user->notifications()->where('read', false)->count();

        // Récupérer les candidatures avec leurs notifications
        $candidatures = $user->candidatures()
            ->with(['offre', 'notifications' => function ($query) {
                $query->where('read', false)->select('id', 'user_id', 'candidature_id', 'message', 'phase', 'read', 'created_at');
            }])
            ->withCount(['notifications as unread_notifications_count' => function ($query) {
                $query->where('read', false);
            }])
            ->get()
            ->map(function ($candidature) {
                // Simuler la structure attendue par la vue
                $notificationsByPhase = $candidature->notifications->groupBy('phase')->map(function ($notifications) {
                    return $notifications->map(function ($notification) {
                        return [
                            'id' => $notification->id,
                            'message' => $notification->message,
                            'created_at' => $notification->created_at,
                            'read' => $notification->read,
                        ];
                    })->toArray();
                })->toArray();

                $unreadCount = $candidature->unread_notifications_count;

                return (object) [
                    'id' => $candidature->id,
                    'offre' => $candidature->offre,
                    'notifications_by_phase' => $notificationsByPhase,
                    'unread_notifications_count' => [
                        'selection' => $unreadCount,
                        'entretien_rh' => $unreadCount,
                        'test_technique' => $unreadCount,
                    ],
                ];
            });

        return view('dashboard', [
            'unreadNotificationsCount' => $unreadNotificationsCount,
            'candidatures' => $candidatures,
        ]);
    }
}
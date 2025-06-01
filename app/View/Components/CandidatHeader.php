<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\View\Component;

class CandidatHeader extends Component
{
    public $unreadNotificationsCount;

    public function __construct()
    {
        $this->unreadNotificationsCount = 0;

        if (Auth::check()) {
            $user = Auth::user();
            Log::info('CandidatHeader: User details', [
                'class' => get_class($user),
                'user_id' => $user->id,
                'role' => $user->role,
                'has_customNotifications' => method_exists($user, 'customNotifications'),
            ]);

            // Reload user to ensure App\Models\User
            $user = User::find($user->id);
            if ($user) {
                try {
                    $this->unreadNotificationsCount = $user->customNotifications()->where('read', false)->count();
                } catch (\Exception $e) {
                    Log::error('CandidatHeader: Failed to count notifications.', [
                        'user_id' => $user->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            } else {
                Log::error('CandidatHeader: Failed to reload user.', ['user_id' => Auth::id()]);
            }
        } else {
            Log::warning('CandidatHeader: No authenticated user.');
        }
    }

    public function render()
    {
        return view('components.candidat-header');
    }
}
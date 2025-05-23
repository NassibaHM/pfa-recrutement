<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CandidatureStatusNotification extends Notification
{
    protected $message;
    protected $candidatureId;
    protected $phase;

    public function __construct($message, $candidatureId, $phase = null)
    {
        $this->message = $message;
        $this->candidatureId = $candidatureId;
        $this->phase = $phase;
    }

    public function storeNotification($notifiable)
    {
        \App\Models\Notification::create([
            'user_id' => $notifiable->id,
            'candidature_id' => $this->candidatureId,
            'message' => $this->message,
            'phase' => $this->phase,
            'read' => false,
        ]);
    }
}
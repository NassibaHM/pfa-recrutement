<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'custom_notifications';

    protected $fillable = ['user_id', 'candidature_id', 'message', 'phase', 'read'];

    protected $casts = [
        'read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}
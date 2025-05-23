<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidatureStatus extends Model
{
    protected $fillable = ['candidature_id', 'phase', 'status', 'retained'];

    protected $casts = [
        'retained' => 'boolean',
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }
}
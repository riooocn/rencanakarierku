<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsesmenResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'recap_scores',
        'top_results',
    ];

    protected $casts = [
        'recap_scores' => 'array',
        'top_results' => 'array',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(AssessmentSession::class, 'session_id');
    }
}

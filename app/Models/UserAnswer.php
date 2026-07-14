<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'question_id',
        'answer_score',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(AssessmentSession::class, 'session_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}

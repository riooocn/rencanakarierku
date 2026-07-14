<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeputusanKarier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'highlight_answers',
        'final_choice',
    ];

    protected $casts = [
        'highlight_answers' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

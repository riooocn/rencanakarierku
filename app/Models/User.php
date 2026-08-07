<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'institution_id',
        'role',
        'grade',
        'phone',
        'status',
        'activated_at',
        'activation_duration_months',
        'expires_at',
        'tanggal_lahir',
        'jenis_kelamin',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'activated_at' => 'datetime',
            'expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if this account has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    /**
     * Get remaining days until expiration.
     * Returns null if no expiry set.
     */
    public function getRemainingDaysAttribute(): ?int
    {
        if ($this->expires_at === null) {
            return null;
        }

        $days = (int) now()->diffInDays($this->expires_at, false);
        return max($days, 0);
    }

    /**
     * Get formatted expiry date string.
     */
    public function getExpiresAtFormattedAttribute(): ?string
    {
        return $this->expires_at?->format('d M Y');
    }

    /**
     * Get duration label.
     */
    public function getDurationLabelAttribute(): ?string
    {
        return $this->activation_duration_months
            ? $this->activation_duration_months . ' Bulan'
            : null;
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function assessmentSessions(): HasMany
    {
        return $this->hasMany(AssessmentSession::class);
    }

    public function eksplorasiKariers(): HasMany
    {
        return $this->hasMany(EksplorasiKarier::class);
    }

    public function keputusanKarier(): HasOne
    {
        return $this->hasOne(KeputusanKarier::class);
    }

    public function keputusanKariers(): HasMany
    {
        return $this->hasMany(KeputusanKarier::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomResetPassword($token));
    }
}

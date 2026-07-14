<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EksplorasiKarier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'option',
        'career_name',
        'pendidikan',
        'jurusan',
        'matkul',
        'keterampilan',
        'pelatihan',
        'sertifikasi',
        'peluang',
        'tugas',
        'info_lain',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

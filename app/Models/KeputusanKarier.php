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
        'test_type',
    ];

    protected $casts = [
        'highlight_answers' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getRiwayatWithIncomplete($userId)
    {
        $riwayatList = self::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
            
        $latestKeputusan = $riwayatList->last();
        $latestKeputusanTime = $latestKeputusan ? $latestKeputusan->created_at : null;
        
        // Check for incomplete progress
        $latestAsesmen = \App\Models\AssessmentSession::where('user_id', $userId)
            ->when($latestKeputusanTime, function($q) use ($latestKeputusanTime) {
                return $q->where('created_at', '>', $latestKeputusanTime);
            })->first();
            
        $latestEksplorasi = \App\Models\EksplorasiKarier::where('user_id', $userId)
            ->when($latestKeputusanTime, function($q) use ($latestKeputusanTime) {
                return $q->where('created_at', '>', $latestKeputusanTime);
            })->first();
            
        if ($latestAsesmen || $latestEksplorasi) {
            // Build an incomplete mock object
            $incomplete = new self();
            $incomplete->incrementing = false;
            $incomplete->id = 'incomplete';
            $incomplete->user_id = $userId;
            
            // Determine test type: if there is an asesmen, it's a full test, otherwise eksplorasi_saja
            $incomplete->test_type = $latestAsesmen ? 'full_test' : 'eksplorasi_saja';
            
            // Set final_choice to Belum Selesai so it plays nice with old views just in case
            $incomplete->final_choice = 'Belum Selesai';
            
            // Use the time of the first action after the last keputusan
            $time1 = $latestAsesmen ? $latestAsesmen->created_at : now();
            $time2 = $latestEksplorasi ? $latestEksplorasi->created_at : now();
            $incomplete->created_at = min($time1, $time2);
            
            $riwayatList->push($incomplete);
        }
        
        foreach ($riwayatList as $riwayat) {
            if ($riwayat->id !== 'incomplete') {
                $riwayat->display_title = 'Selesai';
            } else {
                $riwayat->display_title = 'Belum Selesai';
            }
        }
        
        return $riwayatList;
    }
}

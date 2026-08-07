<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\AsesmenResult;
use App\Models\EksplorasiKarier;
use App\Models\KeputusanKarier;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Get all keputusan karier as history list, including incomplete
        $riwayatList = KeputusanKarier::getRiwayatWithIncomplete($user->id);

        return view('peserta.hasilkeputusan-index', compact('riwayatList'));
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $previousKeputusanTime = null;

        if ($id === 'incomplete') {
            $riwayatList = KeputusanKarier::getRiwayatWithIncomplete($user->id);
            $keputusan = $riwayatList->last();
            if (!$keputusan || $keputusan->id !== 'incomplete') {
                abort(404);
            }
            $targetTime = now(); // For incomplete, get the latest results up to now
            $lastKeputusan = KeputusanKarier::where('user_id', $user->id)->latest('created_at')->first();
            if ($lastKeputusan) {
                $previousKeputusanTime = $lastKeputusan->created_at;
            }
        } else {
            $keputusan = KeputusanKarier::where('user_id', $user->id)->findOrFail($id);
            $targetTime = $keputusan->created_at;
            $lastKeputusan = KeputusanKarier::where('user_id', $user->id)
                ->where('created_at', '<', $keputusan->created_at)
                ->latest('created_at')
                ->first();
            if ($lastKeputusan) {
                $previousKeputusanTime = $lastKeputusan->created_at;
            }
        }

        if ($keputusan->test_type === 'eksplorasi_saja') {
            $minat = null;
            $kapasitas = null;
            $nilaiKarier = null;
        } else {
            $minat = AsesmenResult::whereHas('session', function($q) use ($user) {
                $q->where('user_id', $user->id)->where('asesmen_type', 'minat');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();

            $kapasitas = AsesmenResult::whereHas('session', function($q) use ($user) {
                $q->where('user_id', $user->id)->where('asesmen_type', 'kapasitas');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();

            $nilaiKarier = AsesmenResult::whereHas('session', function($q) use ($user) {
                $q->where('user_id', $user->id)->where('asesmen_type', 'nilai_karier');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();
        }

        $eksplorasi = EksplorasiKarier::where('user_id', $user->id)
            ->where('created_at', '<=', $targetTime)
            ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                return $q->where('created_at', '>', $previousKeputusanTime);
            })
            ->get();

        return view('peserta.hasilkeputusan', compact('minat', 'kapasitas', 'nilaiKarier', 'eksplorasi', 'keputusan'));
    }
}

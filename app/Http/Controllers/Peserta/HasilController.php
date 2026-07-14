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

        // Get all keputusan karier as history list
        $riwayatList = KeputusanKarier::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peserta.hasilkeputusan-index', compact('riwayatList'));
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $keputusan = KeputusanKarier::where('user_id', $user->id)->findOrFail($id);

        $minat = AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'minat');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $kapasitas = AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'kapasitas');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $nilaiKarier = AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'nilai_karier');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $eksplorasi = EksplorasiKarier::where('user_id', $user->id)
            ->where('created_at', '<=', $keputusan->created_at)
            ->get();

        return view('peserta.hasilkeputusan', compact('minat', 'kapasitas', 'nilaiKarier', 'eksplorasi', 'keputusan'));
    }
}

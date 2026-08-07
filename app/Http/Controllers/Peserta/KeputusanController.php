<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\KeputusanKarier;
use Illuminate\Http\Request;

class KeputusanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $minat = \App\Models\AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'minat');
        })->latest()->first();

        $kapasitas = \App\Models\AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'kapasitas');
        })->latest()->first();

        $nilaiKarier = \App\Models\AsesmenResult::whereHas('session', function($q) use ($user) {
            $q->where('user_id', $user->id)->where('asesmen_type', 'nilai_karier');
        })->latest()->first();

        $eksplorasi = \App\Models\EksplorasiKarier::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->take(2)
            ->get()
            ->sortBy('option');
        
        if ($eksplorasi->isEmpty()) {
            return redirect()->route('eksplorasi.index')->with('error', 'Anda harus melakukan eksplorasi karier terlebih dahulu.');
        }

        return view('peserta.keputusan.index', compact('minat', 'kapasitas', 'nilaiKarier', 'eksplorasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'winner' => 'required|string|max:255',
        ]);

        $user = $request->user();

        $testType = $request->session()->get('test_type', 'full_test');

        // Always create a new keputusan to maintain history
        $keputusan = KeputusanKarier::create([
            'user_id' => $user->id,
            'final_choice' => $request->winner,
            'test_type' => $testType,
            'highlight_answers' => [],
        ]);
        
        $request->session()->forget('test_type');

        return redirect()->route('hasilkeputusan.show', $keputusan->id)->with('success', 'Keputusan karier Anda berhasil disimpan.');
    }

    public function winner($id, Request $request)
    {
        $user = $request->user();
        $keputusan = KeputusanKarier::where('user_id', $user->id)->findOrFail($id);
        
        return view('peserta.keputusan.winner', compact('keputusan'));
    }
}

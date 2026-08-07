<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\EksplorasiKarier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EksplorasiController extends Controller
{
    public function intro()
    {
        return view('peserta.eksplorasi.intro');
    }

    public function rencana()
    {
        return view('peserta.eksplorasi.rencana');
    }

    public function ulangi(Request $request)
    {
        $request->session()->put('test_type', 'eksplorasi_saja');
        return redirect()->route('eksplorasi.index');
    }

    public function index()
    {
        return view('peserta.eksplorasi.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'karier1' => 'required|string|max:255',
            'karier2' => 'required|string|max:255',
            // Minimal validasi (bisa ditambahkan kalau perlu)
        ]);

        $user = $request->user();
        
        DB::transaction(function () use ($user, $request) {
            // Data lama tidak dihapus agar tersimpan di riwayat

            $fields = ['pendidikan', 'jurusan', 'matkul', 'keterampilan', 'pelatihan', 'sertifikasi', 'peluang', 'tugas', 'info_lain'];

            $data1 = [
                'user_id' => $user->id,
                'option' => 1,
                'career_name' => $request->karier1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            foreach ($fields as $f) {
                $data1[$f] = $request->input('k1_'.$f);
            }

            $data2 = [
                'user_id' => $user->id,
                'option' => 2,
                'career_name' => $request->karier2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            foreach ($fields as $f) {
                $data2[$f] = $request->input('k2_'.$f);
            }

            EksplorasiKarier::insert([$data1, $data2]);
        });

        return redirect()->route('eksplorasi.hasil');
    }

    public function hasil(Request $request)
    {
        // Hanya ambil 2 data eksplorasi terbaru
        $eksplorasi = EksplorasiKarier::where('user_id', $request->user()->id)
                        ->orderBy('id', 'desc')
                        ->take(2)
                        ->get()
                        ->sortBy('option'); // Sort agar option 1 di atas

        if ($eksplorasi->isEmpty()) {
            return redirect()->route('eksplorasi.index');
        }

        $latestEksplorasi = $eksplorasi->max('created_at');
        $latestKeputusan = \App\Models\KeputusanKarier::where('user_id', $request->user()->id)->latest('created_at')->first();
        $isKeputusanUpToDate = $latestKeputusan && $latestKeputusan->created_at >= $latestEksplorasi;

        return view('peserta.eksplorasi.hasil', compact('eksplorasi', 'isKeputusanUpToDate', 'latestKeputusan'));
    }
}

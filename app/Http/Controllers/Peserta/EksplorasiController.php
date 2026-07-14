<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\EksplorasiKarier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EksplorasiController extends Controller
{
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
            // Hapus data eksplorasi lama jika ada (retake)
            EksplorasiKarier::where('user_id', $user->id)->delete();

            $fields = ['pendidikan', 'jurusan', 'matkul', 'keterampilan', 'pelatihan', 'sertifikasi', 'peluang', 'tugas', 'info_lain'];

            $data1 = [
                'user_id' => $user->id,
                'option' => 1,
                'career_name' => $request->karier1,
            ];
            foreach ($fields as $f) {
                $data1[$f] = $request->input('k1_'.$f);
            }

            $data2 = [
                'user_id' => $user->id,
                'option' => 2,
                'career_name' => $request->karier2,
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
        $eksplorasi = EksplorasiKarier::where('user_id', $request->user()->id)->get();
        if ($eksplorasi->isEmpty()) {
            return redirect()->route('eksplorasi.index');
        }

        return view('peserta.eksplorasi.hasil', compact('eksplorasi'));
    }
}

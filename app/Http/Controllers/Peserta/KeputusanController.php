<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\KeputusanKarier;
use Illuminate\Http\Request;

class KeputusanController extends Controller
{
    public function index()
    {
        return view('peserta.keputusan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'winner' => 'required|string|max:255',
        ]);

        $user = $request->user();

        // Always create a new keputusan to maintain history
        KeputusanKarier::create([
            'user_id' => $user->id,
            'final_choice' => $request->winner,
            'highlight_answers' => [],
        ]);

        return redirect()->route('hasilkeputusan');
    }
}

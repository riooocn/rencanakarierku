<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // As admin, they have an institution_id
        $pesertaCount = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('is_active', true)
            ->count();
            
        $pendingPesertaCount = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('is_active', false)
            ->count();
            
        $pendingPeserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('is_active', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $siswaSelesaiTesCount = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->has('keputusanKarier')
            ->count();
            
        // Can add more stats here
        
        return view('admin.dashboard', compact('pesertaCount', 'pendingPesertaCount', 'pendingPeserta', 'siswaSelesaiTesCount'));
    }

    public function peserta(Request $request)
    {
        $user = $request->user();
        
        $pesertaList = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->with(['assessmentSessions', 'eksplorasiKariers', 'keputusanKarier'])
            ->orderBy('is_active', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.peserta.index', compact('pesertaList'));
    }

    public function pesertaDetail(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('id', $id)
            ->with(['assessmentSessions.result', 'eksplorasiKariers', 'keputusanKarier'])
            ->firstOrFail();
            
        return view('admin.peserta.show', compact('peserta'));
    }

    public function pesertaApprove(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->findOrFail($id);
            
        $peserta->is_active = true;
        $peserta->save();

        return redirect()->back()->with('success', 'Akun peserta berhasil diverifikasi.');
    }
}

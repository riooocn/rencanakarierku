<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AsesmenResult;
use App\Models\EksplorasiKarier;
use App\Models\KeputusanKarier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;
use App\Exports\PesertaAdminExport;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // As admin, they have an institution_id
        $pesertaCount = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('status', 'active')
            ->count();
            
        $pendingPesertaCount = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('status', 'pending')
            ->count();

        // Get recent unverified registrations
        $pendingPeserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('status', 'pending')
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
        
        $query = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->with(['assessmentSessions', 'eksplorasiKariers', 'keputusanKarier']);
            
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
        
        if (request()->filled('grade')) {
            $query->where('grade', request('grade'));
        }
            
        $pesertaList = $query->orderBy('status', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(15)->withQueryString();
            
        return view('admin.peserta.index', compact('pesertaList'));
    }

    public function pesertaDetail(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('id', $id)
            ->firstOrFail();
            
        $riwayatList = KeputusanKarier::where('user_id', $peserta->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.peserta.show', compact('peserta', 'riwayatList'));
    }

    public function pesertaHistoryDetail(Request $request, $id, $history_id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->where('id', $id)
            ->firstOrFail();
            
        $keputusan = KeputusanKarier::where('user_id', $peserta->id)->findOrFail($history_id);

        $minat = AsesmenResult::whereHas('session', function($q) use ($peserta) {
            $q->where('user_id', $peserta->id)->where('asesmen_type', 'minat');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $kapasitas = AsesmenResult::whereHas('session', function($q) use ($peserta) {
            $q->where('user_id', $peserta->id)->where('asesmen_type', 'kapasitas');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $nilaiKarier = AsesmenResult::whereHas('session', function($q) use ($peserta) {
            $q->where('user_id', $peserta->id)->where('asesmen_type', 'nilai_karier');
        })->where('created_at', '<=', $keputusan->created_at)->latest()->first();

        $eksplorasi = EksplorasiKarier::where('user_id', $peserta->id)
            ->where('created_at', '<=', $keputusan->created_at)
            ->get();
            
        return view('admin.peserta.history-show', compact('peserta', 'keputusan', 'minat', 'kapasitas', 'nilaiKarier', 'eksplorasi'));
    }

    public function pesertaApprove(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->findOrFail($id);
            
        $peserta->status = 'active';
        $peserta->activated_at = now();
        $peserta->save();

        return redirect()->back()->with('success', 'Akun peserta berhasil diverifikasi.');
    }

    public function pesertaDeactivate(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->findOrFail($id);
            
        $peserta->status = 'inactive';
        $peserta->save();

        return redirect()->back()->with('success', 'Status peserta berhasil dinon-aktifkan.');
    }
    public function pesertaReject(Request $request, $id)
    {
        $user = $request->user();
        
        $peserta = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->findOrFail($id);
            
        // Hapus data pengguna jika belum diverifikasi (status pending)
        if ($peserta->status === 'pending') {
            $peserta->delete();
            return redirect()->back()->with('success', 'Permintaan pendaftaran peserta berhasil ditolak dan dihapus.');
        }

        return redirect()->back()->with('error', 'Hanya peserta dengan status menunggu verifikasi yang dapat ditolak.');
    }

    public function pesertaBulkAction(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'action' => 'required|in:approve,activate,deactivate,reject',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:users,id',
        ]);

        $action = $request->action;
        $ids = $request->selected_ids;

        $pesertas = User::where('role', 'peserta')
            ->where('institution_id', $user->institution_id)
            ->whereIn('id', $ids)
            ->get();
            
        $count = 0;

        foreach ($pesertas as $peserta) {
            if ($action === 'approve' || $action === 'activate') {
                $peserta->status = 'active';
                $peserta->activated_at = $peserta->activated_at ?? now();
                $peserta->save();
                $count++;
            } elseif ($action === 'deactivate') {
                $peserta->status = 'inactive';
                $peserta->save();
                $count++;
            } elseif ($action === 'reject' && $peserta->status === 'pending') {
                $peserta->delete();
                $count++;
            }
        }

        return redirect()->back()->with('success', "Aksi massal berhasil diterapkan ke {$count} peserta.");
    }

    public function exportExcel(Request $request)
    {
        $user = $request->user();
        $institutionId = $user->institution_id;
        
        return Excel::download(new PesertaAdminExport($institutionId), 'summary_peserta_instansi.xlsx');
    }
}

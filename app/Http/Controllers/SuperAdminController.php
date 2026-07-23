<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Institution;
use App\Models\AsesmenResult;
use App\Models\EksplorasiKarier;
use App\Models\KeputusanKarier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;

class SuperAdminController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->where('status', 'active')->count();
        $pesertaCount = User::where('role', 'peserta')->count();
        $siswaSelesaiTesCount = User::where('role', 'peserta')->has('keputusanKarier')->count();
        $institutionCount = Institution::whereHas('users', function ($q) {
            $q->where('role', 'admin');
        })->count();
        
        $pendingAdmins = User::where('role', 'admin')
            ->where('status', 'pending')
            ->with('institution')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        $pendingAdminsCount = User::where('role', 'admin')->where('status', 'pending')->count();
        
        return view('superadmin.dashboard', compact('adminCount', 'pesertaCount', 'siswaSelesaiTesCount', 'institutionCount', 'pendingAdmins', 'pendingAdminsCount'));
    }

    public function adminList(Request $request)
    {
        $search = $request->query('search');

        $query = User::where('role', 'admin')
            ->with(['institution' => function ($query) {
                $query->withCount(['users as peserta_count' => function ($q) {
                    $q->where('role', 'peserta');
                }]);
            }]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('institution', function ($qInst) use ($search) {
                      $qInst->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $adminList = $query->orderBy('status', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends(['search' => $search]);

        return view('superadmin.admin.index', compact('adminList'));
    }

    public function adminApprove($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->status = 'active';
        $admin->save();
        
        return redirect()->back()->with('success', 'Akun admin berhasil diverifikasi.');
    }

    public function adminDeactivate($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->status = 'inactive';
        $admin->save();
        
        return redirect()->back()->with('success', 'Status admin berhasil dinon-aktifkan.');
    }

    public function adminReject($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        
        if ($admin->status === 'pending') {
            $admin->delete();
            return redirect()->back()->with('success', 'Permintaan pendaftaran admin berhasil ditolak dan dihapus.');
        }

        return redirect()->back()->with('error', 'Hanya admin dengan status menunggu verifikasi yang dapat ditolak.');
    }

    public function adminPeserta($admin_id)
    {
        $admin = User::where('role', 'admin')->findOrFail($admin_id);
        
        $query = User::where('role', 'peserta')
            ->where('institution_id', $admin->institution_id)
            ->with(['assessmentSessions', 'eksplorasiKariers', 'keputusanKarier']);
            
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
            
        $pesertaList = $query->paginate(15)->withQueryString();
            
        return view('superadmin.peserta.index', compact('pesertaList', 'admin'));
    }

    public function pesertaList()
    {
        $query = User::where('role', 'peserta')
            ->with(['institution', 'assessmentSessions', 'eksplorasiKariers', 'keputusanKarier']);
            
        if (request()->filled('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }
        
        if (request()->filled('institution_id')) {
            $query->where('institution_id', request('institution_id'));
        }
            
        $pesertaList = $query->paginate(20)->withQueryString();
            
        return view('superadmin.peserta.index', compact('pesertaList'));
    }

    public function pesertaDetail($id)
    {
        $peserta = User::where('role', 'peserta')
            ->where('id', $id)
            ->with(['institution'])
            ->firstOrFail();
            
        $riwayatList = KeputusanKarier::where('user_id', $peserta->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('superadmin.peserta.show', compact('peserta', 'riwayatList'));
    }

    public function pesertaHistoryDetail($id, $history_id)
    {
        $peserta = User::where('role', 'peserta')
            ->where('id', $id)
            ->with(['institution'])
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
            
        return view('superadmin.peserta.history-show', compact('peserta', 'keputusan', 'minat', 'kapasitas', 'nilaiKarier', 'eksplorasi'));
    }

    public function pesertaApprove($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        $peserta->status = 'active';
        $peserta->save();
        
        return redirect()->back()->with('success', 'Akun peserta berhasil diverifikasi.');
    }

    public function pesertaDeactivate($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        $peserta->status = 'inactive';
        $peserta->save();
        
        return redirect()->back()->with('success', 'Status peserta berhasil dinon-aktifkan.');
    }

    public function pesertaReject($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        
        if ($peserta->status === 'pending') {
            $peserta->delete();
            return redirect()->back()->with('success', 'Permintaan pendaftaran peserta berhasil ditolak dan dihapus.');
        }

        return redirect()->back()->with('error', 'Hanya peserta dengan status menunggu verifikasi yang dapat ditolak.');
    }

    public function exportExcel(Request $request)
    {
        $institutionId = $request->query('institution_id');
        return Excel::download(new PesertaExport($institutionId), 'data_peserta_keseluruhan.xlsx');
    }
}

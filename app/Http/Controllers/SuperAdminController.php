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
        
        // Count accounts expiring within 30 days
        $soonExpiringCount = User::where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now()->addDays(30))
            ->where('expires_at', '>', now())
            ->count();
        
        return view('superadmin.dashboard', compact('adminCount', 'pesertaCount', 'siswaSelesaiTesCount', 'institutionCount', 'pendingAdmins', 'pendingAdminsCount', 'soonExpiringCount'));
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
        $admin->activated_at = now();
        $admin->save();
        
        return redirect()->back()->with('success', 'Akun admin berhasil diverifikasi.');
    }

    public function setAdminDuration(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|in:3,6,12',
        ]);

        $admin = User::where('role', 'admin')->findOrFail($id);
        
        if ($admin->status !== 'active') {
            return redirect()->back()->with('error', 'Durasi hanya bisa diatur untuk akun yang aktif.');
        }

        $duration = (int) $request->duration;
        $activatedAt = $admin->activated_at ?? now();
        
        $admin->activated_at = $activatedAt;
        $admin->activation_duration_months = $duration;
        $admin->expires_at = $activatedAt->copy()->addMonths($duration);
        $admin->save();

        return redirect()->back()->with('success', "Durasi aktif admin berhasil diatur ke {$duration} bulan.");
    }

    public function removeAdminDuration($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        
        $admin->activation_duration_months = null;
        $admin->expires_at = null;
        $admin->save();

        return redirect()->back()->with('success', 'Durasi aktif admin dihapus. Akun berlaku tanpa batas waktu.');
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

    public function adminBulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,activate,deactivate,reject',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:users,id',
        ]);

        $action = $request->action;
        $ids = $request->selected_ids;

        $admins = User::where('role', 'admin')->whereIn('id', $ids)->get();
        $count = 0;

        foreach ($admins as $admin) {
            if ($action === 'approve' || $action === 'activate') {
                $admin->status = 'active';
                $admin->activated_at = $admin->activated_at ?? now();
                $admin->save();
                $count++;
            } elseif ($action === 'deactivate') {
                $admin->status = 'inactive';
                $admin->save();
                $count++;
            } elseif ($action === 'reject' && $admin->status === 'pending') {
                $admin->delete();
                $count++;
            }
        }

        return redirect()->back()->with('success', "Aksi massal berhasil diterapkan ke {$count} admin.");
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
            
        $riwayatList = KeputusanKarier::getRiwayatWithIncomplete($peserta->id);
            
        return view('superadmin.peserta.show', compact('peserta', 'riwayatList'));
    }

    public function pesertaHistoryDetail($id, $history_id)
    {
        $peserta = User::where('role', 'peserta')
            ->where('id', $id)
            ->with(['institution'])
            ->firstOrFail();
            
        $previousKeputusanTime = null;

        if ($history_id === 'incomplete') {
            $riwayatList = KeputusanKarier::getRiwayatWithIncomplete($peserta->id);
            $keputusan = $riwayatList->last();
            if (!$keputusan || $keputusan->id !== 'incomplete') {
                abort(404);
            }
            $targetTime = now();
            $lastKeputusan = KeputusanKarier::where('user_id', $peserta->id)->latest('created_at')->first();
            if ($lastKeputusan) {
                $previousKeputusanTime = $lastKeputusan->created_at;
            }
        } else {
            $keputusan = KeputusanKarier::where('user_id', $peserta->id)->findOrFail($history_id);
            $targetTime = $keputusan->created_at;
            $lastKeputusan = KeputusanKarier::where('user_id', $peserta->id)
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
            $minat = AsesmenResult::whereHas('session', function($q) use ($peserta) {
                $q->where('user_id', $peserta->id)->where('asesmen_type', 'minat');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();

            $kapasitas = AsesmenResult::whereHas('session', function($q) use ($peserta) {
                $q->where('user_id', $peserta->id)->where('asesmen_type', 'kapasitas');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();

            $nilaiKarier = AsesmenResult::whereHas('session', function($q) use ($peserta) {
                $q->where('user_id', $peserta->id)->where('asesmen_type', 'nilai_karier');
            })->where('created_at', '<=', $targetTime)
              ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                  return $q->where('created_at', '>', $previousKeputusanTime);
              })->latest()->first();
        }

        $eksplorasi = EksplorasiKarier::where('user_id', $peserta->id)
            ->where('created_at', '<=', $targetTime)
            ->when(isset($previousKeputusanTime), function($q) use ($previousKeputusanTime) {
                return $q->where('created_at', '>', $previousKeputusanTime);
            })
            ->get();
            
        return view('superadmin.peserta.history-show', compact('peserta', 'keputusan', 'minat', 'kapasitas', 'nilaiKarier', 'eksplorasi'));
    }

    public function pesertaApprove($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        $peserta->status = 'active';
        $peserta->activated_at = now();
        $peserta->save();
        
        return redirect()->back()->with('success', 'Akun peserta berhasil diverifikasi.');
    }

    public function setPesertaDuration(Request $request, $id)
    {
        $request->validate([
            'duration' => 'required|in:3,6,12',
        ]);

        $peserta = User::where('role', 'peserta')->findOrFail($id);
        
        if ($peserta->status !== 'active') {
            return redirect()->back()->with('error', 'Durasi hanya bisa diatur untuk akun yang aktif.');
        }

        $duration = (int) $request->duration;
        $activatedAt = $peserta->activated_at ?? now();
        
        $peserta->activated_at = $activatedAt;
        $peserta->activation_duration_months = $duration;
        $peserta->expires_at = $activatedAt->copy()->addMonths($duration);
        $peserta->save();

        return redirect()->back()->with('success', "Durasi aktif peserta berhasil diatur ke {$duration} bulan.");
    }

    public function removePesertaDuration($id)
    {
        $peserta = User::where('role', 'peserta')->findOrFail($id);
        
        $peserta->activation_duration_months = null;
        $peserta->expires_at = null;
        $peserta->save();

        return redirect()->back()->with('success', 'Durasi aktif peserta dihapus. Akun berlaku tanpa batas waktu.');
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

    public function pesertaBulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,activate,deactivate,reject',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:users,id',
        ]);

        $action = $request->action;
        $ids = $request->selected_ids;

        $pesertas = User::where('role', 'peserta')->whereIn('id', $ids)->get();
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
        $institutionId = $request->query('institution_id');
        return Excel::download(new PesertaExport($institutionId), 'data_peserta_keseluruhan.xlsx');
    }
}

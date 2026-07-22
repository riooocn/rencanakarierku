<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;

class SuperAdminController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $pesertaCount = User::where('role', 'peserta')->count();
        $siswaSelesaiTesCount = User::where('role', 'peserta')->has('keputusanKarier')->count();
        $institutionCount = Institution::whereHas('users', function ($q) {
            $q->where('role', 'admin');
        })->count();
        
        $pendingAdmins = User::where('role', 'admin')
            ->where('is_active', false)
            ->with('institution')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        $pendingAdminsCount = User::where('role', 'admin')->where('is_active', false)->count();
        
        return view('superadmin.dashboard', compact('adminCount', 'pesertaCount', 'siswaSelesaiTesCount', 'institutionCount', 'pendingAdmins', 'pendingAdminsCount'));
    }

    public function adminList()
    {
        $adminList = User::where('role', 'admin')
            ->with(['institution' => function ($query) {
                $query->withCount(['users as peserta_count' => function ($q) {
                    $q->where('role', 'peserta');
                }]);
            }])
            ->orderBy('is_active', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('superadmin.admin.index', compact('adminList'));
    }

    public function adminApprove($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->is_active = true;
        $admin->save();
        
        return redirect()->back()->with('success', 'Akun admin berhasil disetujui/diaktifkan.');
    }

    public function adminDeactivate($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->is_active = false;
        $admin->save();
        
        return redirect()->back()->with('success', 'Akun admin berhasil dinonaktifkan.');
    }

    public function adminPeserta($admin_id)
    {
        $admin = User::where('role', 'admin')->findOrFail($admin_id);
        
        $pesertaList = User::where('role', 'peserta')
            ->where('institution_id', $admin->institution_id)
            ->with(['assessmentSessions', 'eksplorasiKariers', 'keputusanKarier'])
            ->paginate(15);
            
        return view('superadmin.peserta.index', compact('pesertaList', 'admin'));
    }

    public function pesertaList()
    {
        $pesertaList = User::where('role', 'peserta')
            ->with(['institution', 'assessmentSessions', 'eksplorasiKariers', 'keputusanKarier'])
            ->paginate(20);
            
        return view('superadmin.peserta.index', compact('pesertaList'));
    }

    public function pesertaDetail($id)
    {
        $peserta = User::where('role', 'peserta')
            ->where('id', $id)
            ->with(['institution', 'assessmentSessions.result', 'eksplorasiKariers', 'keputusanKarier'])
            ->firstOrFail();
            
        return view('superadmin.peserta.show', compact('peserta'));
    }

    public function exportExcel(Request $request)
    {
        $institutionId = $request->query('institution_id');
        return Excel::download(new PesertaExport($institutionId), 'data_peserta_keseluruhan.xlsx');
    }
}

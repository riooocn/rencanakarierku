<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        if ($request->filled('new_school')) {
            $institution = Institution::firstOrCreate(['name' => $request->new_school]);
        } else {
            $request->validate(['school_id' => 'required|exists:institutions,id']);
            $institution = Institution::find($request->school_id);
        }

        $user = $request->user();

        if ($user->role === 'admin') {
            $adminCount = User::where('institution_id', $institution->id)
                              ->where('role', 'admin')
                              ->where('id', '!=', $user->id)
                              ->count();
            if ($adminCount >= 3) {
                return back()->withErrors(['school_id' => 'Instansi ini sudah mencapai batas maksimal 3 admin.'])->withInput();
            }
        }
        
        $user->institution_id = $institution->id;
        $user->phone = $request->phone;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        
        if ($user->role === 'peserta') {
            $request->validate(['grade' => 'required|string|max:50']);
            $user->grade = $request->grade;
        }

        $user->save();

        if ($user->role === 'admin') {
            if ($user->status === 'pending' || $user->status === 'inactive') {
                $status = $user->status;
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($status === 'inactive') {
                    return redirect('/login')->with('account_inactive', true);
                }

                $targetNumber = '6282139026026';
                $waText = "Halo Tim Rencana Karierku,\n\nPerkenalkan saya {$user->name} dari {$institution->name} \nNo telp: {$user->phone}\n\nMohon untuk konfirmasi akun admin untuk instansi {$institution->name} segera. Saya sedang menunggu agar akun dapat diverifikasi.";
                $waUrl = 'https://wa.me/' . $targetNumber . '?text=' . rawurlencode($waText);

                return redirect('/login')->with([
                    'account_pending' => 'Pendaftaran Admin berhasil. Silakan tekan tombol WhatsApp untuk konfirmasi akun Anda ke Super Admin.',
                    'login_wa_redirect' => $waUrl
                ]);
            }
            return redirect('/admin')->with('success', 'Profil berhasil dilengkapi.');
        }

        // For peserta
        if ($user->status === 'pending' || $user->status === 'inactive') {
            $status = $user->status;
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($status === 'inactive') {
                return redirect('/login')->with('account_inactive', true);
            }
            
            return redirect('/login')->with('account_pending', 'Pendaftaran berhasil. Akun Anda sedang menunggu verifikasi dari Admin Instansi.');
        }

        return redirect('/perjalananku')->with('success', 'Profil berhasil dilengkapi.');
    }
}

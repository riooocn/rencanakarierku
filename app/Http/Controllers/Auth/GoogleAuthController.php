<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request, $role = 'peserta')
    {
        $request->session()->put('google_role', $role);
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if ($user && $user->password) {
                return redirect('/login')->withErrors(['email' => 'Akun ini terdaftar secara manual. Silakan masuk menggunakan email dan password.']);
            }

            if (!$user) {
                $role = $request->session()->pull('google_role', 'peserta');
                
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => $role,
                    'password' => null,
                    'is_active' => false,
                ]);
            } elseif (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }

            Auth::login($user);

            // Jika belum ada asal sekolah/instansi, maka profil belum lengkap
            if (!$user->institution_id) {
                return redirect()->route('complete-profile-' . $user->role);
            }

            // Jika role admin atau peserta tapi belum aktif
            if ($user->role !== 'superadmin' && !$user->is_active) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->with('status', 'Akun Anda sedang menunggu verifikasi.');
            }

            if ($user->role === 'superadmin') {
                return redirect('/superadmin')->with('success', 'Berhasil masuk dengan Google.');
            } elseif ($user->role === 'admin') {
                return redirect('/admin')->with('success', 'Berhasil masuk dengan Google.');
            }

            return redirect('/perjalananku')->with('success', 'Berhasil masuk dengan Google.');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }
    }
}

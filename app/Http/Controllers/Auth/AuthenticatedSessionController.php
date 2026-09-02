<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = $request->user();

        if ($user->role !== 'superadmin' && $user->status !== 'active') {
            $status = $user->status;
            $role = $user->role;
            
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($status === 'inactive') {
                return redirect('/login')->with('account_inactive', true);
            }
            
            $msg = $role === 'admin' 
                ? 'Akun admin Anda sedang menunggu verifikasi oleh Super Admin.' 
                : 'Akun Anda sedang menunggu verifikasi oleh Admin Instansi.';
                
            $redirectData = ['account_pending' => $msg];
            
            if ($role === 'admin') {
                $institutionName = $user->institution ? $user->institution->name : 'Instansi';
                $targetNumber = '6282139026026';
                $waText = "Halo Tim Rencana Karierku,\n\nPerkenalkan saya {$user->name} dari {$institutionName} \nNo telp: {$user->phone}\n\nMohon untuk konfirmasi akun admin untuk instansi {$institutionName} segera. Saya sedang menunggu agar akun dapat diverifikasi.";
                $redirectData['login_wa_redirect'] = 'https://wa.me/' . $targetNumber . '?text=' . rawurlencode($waText);
            }
                
            return redirect('/login')->with($redirectData);
        }

        $request->session()->regenerate();

        if ($user->role === 'superadmin') {
            return redirect()->intended('/superadmin')->with('success', 'Berhasil masuk ke dalam sistem.');
        } elseif ($user->role === 'admin') {
            return redirect()->intended('/admin')->with('success', 'Berhasil masuk ke dalam sistem.');
        }

        return redirect()->intended('/perjalananku')->with('success', 'Berhasil masuk ke dalam sistem.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}

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

        if ($user->role !== 'superadmin' && !$user->is_active) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $msg = $user->role === 'admin' 
                ? 'Akun admin Anda sedang menunggu verifikasi oleh Super Admin.' 
                : 'Akun Anda sedang menunggu verifikasi oleh Admin Instansi.';
                
            return redirect('/login')->withErrors([
                'email' => $msg,
            ]);
        }

        $request->session()->regenerate();

        if ($user->role === 'superadmin') {
            return redirect()->intended('/superadmin');
        } elseif ($user->role === 'admin') {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/perjalananku');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

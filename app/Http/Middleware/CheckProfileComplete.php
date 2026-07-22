<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role !== 'superadmin') {
            // Check if profile is incomplete
            if (empty($user->institution_id) || empty($user->tanggal_lahir) || empty($user->jenis_kelamin)) {
                // Allow them to access complete-profile pages, logout, home, contact and storing profile
                if (! $request->routeIs('home', 'contact', 'complete-profile-peserta', 'complete-profile-instansi', 'complete-profile.store', 'logout')) {
                    if ($user->role === 'peserta') {
                        return redirect()->route('complete-profile-peserta');
                    } elseif ($user->role === 'admin') {
                        return redirect()->route('complete-profile-instansi');
                    }
                }
            } else {
                // Profile is complete, but account might not be active (verified)
                if (! $user->is_active) {
                    if (! $request->routeIs('home', 'contact', 'logout')) {
                        $msg = $user->role === 'admin' 
                            ? 'Akun admin Anda sedang menunggu verifikasi oleh Super Admin.' 
                            : 'Akun Anda sedang menunggu verifikasi oleh Admin Instansi.';
                        return redirect()->route('home')->with('error', $msg);
                    }
                }
            }
        }

        return $next($request);
    }
}

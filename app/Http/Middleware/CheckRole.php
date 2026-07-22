<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect('/login');
        }

        $user = $request->user();

        if (! in_array($request->user()->role, $roles)) {
            // Redirect based on current role if they don't have access
            $role = $request->user()->role;
            if ($role === 'superadmin') {
                return redirect('/superadmin');
            } elseif ($role === 'admin') {
                return redirect('/admin');
            }
            return redirect('/perjalananku');
        }

        return $next($request);
    }
}

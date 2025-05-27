<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Pisahkan role jika lebih dari satu (pakai koma di route)
        $allowedRoles = explode(',', $roles);

        // Cek apakah role user termasuk dalam allowedRoles
        if (!in_array($user->role, $allowedRoles)) {
            // Redirect ke halaman yang relevan atau ke route tertentu
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki hak untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}

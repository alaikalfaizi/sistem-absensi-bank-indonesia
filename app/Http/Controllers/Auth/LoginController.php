<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Arahkan setelah login sesuai dengan role
    protected function redirectTo()
    {
        $user = auth()->user();
    
        if ($user->role === 'admin') {
            return route('admin.dashboard'); // ✅ arahkan ke route yang benar
        } elseif ($user->role === 'staff') {
            return route('staff.dashboard');
        } elseif ($user->role === 'karyawan') {
            return route('karyawan.dashboard');
        }
    
        return '/home';
    }
    
    // Menyimpan waktu login terakhir
    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => now(),
        ]);
    }
}




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->has('remember'))) {

            $user = auth()->user();

            // Simpan waktu login terakhir
            $user->last_login_at = now();
            $user->save();

            \Log::info('Last login updated', [
                'user_id' => $user->id,
                'last_login_at' => $user->last_login_at
            ]);

            $message = 'Berhasil login sebagai ' . ucfirst($user->role);

            // Redirect sesuai role, dengan flash success message
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', $message);
                case 'staff':
                    return redirect()->route('staff.dashboard')->with('success', $message);
                case 'magang':
                    return redirect()->route('magang.dashboard')->with('success', $message);
                case 'karyawan':
                    return redirect()->route('karyawan.dashboard')->with('success', $message);
                default:
                    abort(403);
            }
        }

        // Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

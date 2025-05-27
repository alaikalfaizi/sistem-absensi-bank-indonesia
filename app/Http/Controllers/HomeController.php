<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        \Log::info('User Login:', [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role, // bukan getRoleNames()
        ]);
    
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } elseif ($user->role === 'magang') {
            return redirect()->route('magang.dashboard');
        } else {
            abort(403, 'Akses tidak diizinkan');
        }
    }
    
}

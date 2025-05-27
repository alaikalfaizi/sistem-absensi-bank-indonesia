<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User; // Untuk mengambil data bawahan
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    // Untuk Staff & Karyawan: Menampilkan Logbook Hari Ini (bisa dipakai di dashboard)
    public function indexHariIni()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $logbookHariIni = Logbook::where('user_id', $user->id)
        ->whereDate('tanggal', $today)
            ->get();

        // Cek role untuk arahkan ke view yang sesuai
        if ($user->hasRole('staff')) {
            return view('staff.staff_dashboard', compact('logbookHariIni'));
        } elseif ($user->hasRole('karyawan')) {
            return view('karyawan.dashboard', compact('logbookHariIni'));
        }

        abort(403, 'Unauthorized');
    }

    // Untuk semua user: Riwayat aktivitas pribadi
    public function showRiwayatAktivitas()
    {
        $user = auth()->user();

        $logbooks = Logbook::where('user_id', $user->id)
        ->orderBy('tanggal', 'desc')
            ->get();

        return view('logbook.riwayataktivitas', compact('logbooks'));
    }

    // Untuk admin: Lihat semua logbook dari semua user
    public function index(Request $request)
    {
        // Pencarian berdasarkan tanggal dan user (admin bisa filter)
        $logbooks = Logbook::query();

        // Filter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $logbooks->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan user ID (admin hanya dapat melihat logbook pengguna tertentu)
        if ($request->has('user_id') && $request->user_id != '') {
            $logbooks->where('user_id', $request->user_id);
        }
        
        }

        $logbooks = $logbooks->latest()->get();

        return view('logbook.index', compact('logbooks'));
    }

    // Form input manual logbook (bisa dipakai admin/karyawan)
    public function create()
    {
        return view('logbook.create');
    }

    // Menyimpan logbook dengan input tanggal (biasa dari form create)
    public function store(Request $request)
    {
        $request->validate([
            'aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Logbook::create([
            'user_id' => auth()->user()->id,
            'aktivitas' => $request->aktivitas,
            'deskripsi' => $request->deskripsi,
            'tanggal' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil disimpan.');
    }

    // Menyimpan logbook langsung dari dashboard (otomatis tanggal hari ini)
    public function storeLogbook(Request $request)
    {
        $request->validate([
            'aktivitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Logbook::create([
            'user_id' => auth()->id(),
            'tanggal' => now()->toDateString(),
            'aktivitas' => $request->aktivitas,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Logbook berhasil disimpan!');
    }

    // Staff lihat logbook semua karyawan (bawahan)
    public function logbookBawahan()
    {
        $user = Auth::user();

        // Ambil daftar bawahan (misalnya berdasarkan relasi 'users' yang memiliki role 'karyawan')
        $bawahan = User::where('manager_id', $user->id)->get();

        // Ambil logbook dari semua bawahan
        $logbooks = Logbook::whereIn('user_id', $bawahan->pluck('id'))
        ->orderBy('tanggal', 'desc')
            ->get();

        return view('logbook.bawahan', compact('logbooks'));
    }
}

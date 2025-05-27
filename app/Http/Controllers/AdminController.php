<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\PendaftarMagang;
use Carbon\Carbon;
use App\Models\ProgramKerja;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;
use App\Exports\AbsensiExport; // Import AbsensiExport
use App\Exports\LogbookExport; // Import LogbookExport
use App\Exports\ProgramKerjaExport; // Import ProgramKerjaExport




class AdminController extends Controller
{

    public function pesertaMagang()
    {
        // Ambil semua data peserta magang
        $pesertaMagang = PendaftarMagang::all();

        // Tampilkan data peserta magang di halaman admin
        return view('admin.peserta_magang', compact('pesertaMagang'));
    }


    public function showPesertaMagang($id)
    {
        // Ambil data peserta magang berdasarkan id
        $pendaftar = PendaftarMagang::findOrFail($id);

        // Tampilkan halaman detail peserta magang
        return view('admin.detail_peserta_magang', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftar = PendaftarMagang::findOrFail($id);
        $pendaftar->status = $request->status;
        $pendaftar->save();
    
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
    

    
    // AdminController.php
public function showCreateUserForm()
{
    return view('admin.create-user'); // Halaman form pendaftaran user untuk admin
}

public function showLoginForm()
{
    return view('auth.login'); // Pastikan view ini ada di resources/views/auth/login.blade.php
}

public function createUser(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,staff,magang', // pastikan role yang dimasukkan valid
    ]);

    // Cek nilai role yang diterima dari form
    \Log::info('Role yang diterima: ' . $validated['role']);

    // Buat user baru
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'], // pastikan role tersimpan dengan benar
    ]);

    return redirect()->route('admin.manageUsers')->with('success', 'User created successfully');
}


private function getUserIdByRole($role)
{
    switch ($role) {
        case 'admin':
            return 1;
        case 'staff':
            return 2;
        case 'magang':
            return 3;
        default:
            return 0;
    }
}

public function dashboard()
{
    $user = auth()->user();
    $tanggalHariIni = today(); // Tanggal hari ini

    // Jumlah total
    $jumlahStaff = User::where('role', 'staff')->count();
    $jumlahKaryawan = User::where('role', 'magang')->count(); // 'magang' sesuai standar role
    $jumlahAbsensi = Absensi::count();
    $jumlahLogbook = Logbook::count();

    // Absensi dan logbook hari ini (semua user)
    $absensiHariIni = Absensi::with('user')
        ->whereDate('tanggal', $tanggalHariIni)
        ->get();

    $logbookHariIni = Logbook::with('user')
        ->whereDate('tanggal', $tanggalHariIni)
        ->get();

    // 5 logbook terakhir semua user
    $logbooks = Logbook::with('user')
        ->orderBy('tanggal', 'desc')
        ->take(5)
        ->get();

    // Ambil absensi hari ini khusus untuk admin sendiri
    $absensiHariIniUser = $user->absensi()
        ->whereDate('tanggal', $tanggalHariIni)
        ->first();

    return view('dashboard.admin_dashboard', compact(
        'user',
        'jumlahStaff',
        'jumlahKaryawan',
        'jumlahAbsensi',
        'jumlahLogbook',
        'absensiHariIni',
        'logbookHariIni',
        'logbooks',
        'absensiHariIniUser'
    ));
}


    

public function absensi()
{
    $absensiHariIni = Absensi::with('user')->whereDate('tanggal', today())->get();

    // Pisahkan data absensi berdasarkan role user
    $absensiStaff = $absensiHariIni->filter(function($absen) {
        return $absen->user->role === 'staff';
    });

    $absensiMagang = $absensiHariIni->filter(function($absen) {
        return $absen->user->role === 'magang';
    });

    return view('admin.absensi', compact('absensiStaff', 'absensiMagang'));
}


public function logbook()
{
    // Ambil logbook hari ini untuk semua user
    $logbook = Logbook::with('user')->whereDate('tanggal', today())->get();

    // Pisahkan data logbook berdasarkan role user
    $logbookStaff = $logbook->filter(function($item) {
        return $item->user->role === 'staff';
    });

    $logbookMagang = $logbook->filter(function($item) {
        return $item->user->role === 'magang';
    });

    return view('admin.logbook', compact('logbookStaff', 'logbookMagang'));
}


    public function staff()
    {
        $staffs = User::where('role', 'staff')->get();
        return view('admin.staff', compact('staffs'));
    }

    public function karyawan()
    {
        $karyawans = User::where('role', 'karyawan')->get();
        return view('admin.karyawan', compact('karyawans'));
    }

    public function manageUsers()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.manage_users', compact('users'));
    }

    public function storeAbsensiMasuk(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jam_masuk' => 'required|date_format:H:i:s',
            'keterangan' => 'nullable',
        ]);

        $tanggalHariIni = now()->toDateString();

        $jamMasuk = Carbon::createFromFormat('H:i:s', $request->jam_masuk)
            ->format('Y-m-d') . ' ' . Carbon::createFromFormat('H:i:s', $request->jam_masuk)->format('H:i:s');

        $absensiExist = Absensi::where('user_id', $request->user_id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->first();

        if ($absensiExist) {
            return redirect()->back()->with('error', 'User sudah melakukan absensi hari ini.');
        }

        Absensi::create([
            'user_id' => $request->user_id,
            'jam_masuk' => $jamMasuk,
            'keterangan' => $request->keterangan,
            'tanggal' => $tanggalHariIni,
        ]);

        return redirect()->back()->with('success', 'Absensi masuk berhasil disimpan.');
    }

    public function storeAbsensiKeluar(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jam_keluar' => 'required|date_format:H:i:s',
            'keterangan' => 'nullable',
        ]);

        $tanggalHariIni = now()->toDateString();

        $jamKeluar = Carbon::createFromFormat('H:i:s', $request->jam_keluar)
            ->format('Y-m-d') . ' ' . Carbon::createFromFormat('H:i:s', $request->jam_keluar)->format('H:i:s');

        $absensiExist = Absensi::where('user_id', $request->user_id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->first();

        if (!$absensiExist) {
            return redirect()->back()->with('error', 'User belum melakukan absensi masuk.');
        }

        $absensiExist->update([
            'jam_keluar' => $jamKeluar,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Absensi keluar berhasil disimpan.');
    }

    public function storeLogbook(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'aktivitas' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Logbook::create([
            'user_id' => $request->user_id,
            'aktivitas' => $request->aktivitas,
            'deskripsi' => $request->deskripsi,
            'tanggal' => now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil disimpan.');
    }

    public function rekap(Request $request)
    {
        // Ambil daftar bulan yang tersedia berdasarkan Absensi dan Logbook
        $bulanList = Absensi::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan")
            ->union(Logbook::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as bulan"))
            ->distinct()
            ->orderBy('bulan', 'desc')
            ->pluck('bulan');
    
        $rekap = [];
        // Ambil semua user dengan role 'staff' dan 'magang'
        $semuaStaff = User::where('role', 'staff')->get();
        $semuaMagang = User::where('role', 'magang')->get();
    
        // Loop untuk setiap bulan dan karyawan
        foreach ($bulanList as $bulan) {
            $start = \Carbon\Carbon::parse($bulan . '-01')->startOfMonth();
            $end = \Carbon\Carbon::parse($bulan . '-01')->endOfMonth();
    
            $rekap[$bulan] = [];
    
            // Menghitung absensi dan logbook per bulan untuk staff
            foreach ($semuaStaff as $staff) {
                $rekap[$bulan]['staff'][$staff->id] = [
                    'absensi' => Absensi::where('user_id', $staff->id)
                                        ->whereBetween('tanggal', [$start, $end])
                                        ->count(),
                    'logbook' => Logbook::where('user_id', $staff->id)
                                        ->whereBetween('tanggal', [$start, $end])
                                        ->count(),
                ];
            }
    
            // Menghitung absensi dan logbook per bulan untuk magang
            foreach ($semuaMagang as $magang) {
                $rekap[$bulan]['magang'][$magang->id] = [
                    'absensi' => Absensi::where('user_id', $magang->id)
                                        ->whereBetween('tanggal', [$start, $end])
                                        ->count(),
                    'logbook' => Logbook::where('user_id', $magang->id)
                                        ->whereBetween('tanggal', [$start, $end])
                                        ->count(),
                ];
            }
        }
    
        // Menangani bulan yang dipilih oleh user atau default bulan pertama
        $bulanTerpilih = $request->input('bulan') ?? $bulanList->first();
    
        // Kirim data ke view
        return view('admin.rekap_bulanan', [
            'rekap' => $rekap,
            'bulanList' => $bulanList,
            'bulan' => $bulanTerpilih,
            'semuaStaff' => $semuaStaff,  // Menambahkan data staff
            'semuaMagang' => $semuaMagang,  // Menambahkan data magang
        ]);
    }
    

    public function showProgramKerja()
    {
        $programKerja = ProgramKerja::with('user')->get(); // Mengambil data program kerja beserta relasi user
        return view('admin.program_kerja', compact('programKerja'));
    }
    

public function exportRekap(Request $request)
{
    $bulan = $request->query('bulan');
    
    // Menggunakan RekapExport untuk export data
    return Excel::download(new RekapExport($bulan), 'rekap_' . ($bulan ?? now()->format('Y_m')) . '.xlsx');
}

public function exportAbsensi(Request $request)
{
    return Excel::download(new AbsensiExport, 'absensi.xlsx');
}

public function exportLogbook(Request $request)
{
    return Excel::download(new LogbookExport, 'logbook.xlsx');
}

}
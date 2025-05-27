<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\ProgramKerja;
use Carbon\Carbon;
use Auth;

class MagangController extends Controller
{
    // Dashboard Magang
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Ambil absensi dan logbook hari ini
        $absensiHariIni = Absensi::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        $logbookHariIni = Logbook::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // Hitung total absensi dan logbook untuk bulan ini
        $absensiPerBulan = Absensi::where('user_id', $user->id)
            ->whereMonth('tanggal', $today->month)
            ->count();

        $logbooksPerBulan = Logbook::where('user_id', $user->id)
            ->whereMonth('tanggal', $today->month)
            ->count();

        // Persiapkan data grafik harian
        $tanggalBulanIni = [];
        $absensiPerTanggal = [];
        $logbookPerTanggal = [];

        for ($i = 1; $i <= $today->daysInMonth; $i++) {
            $date = Carbon::create($today->year, $today->month, $i);
            $tanggalBulanIni[] = $date->format('d-m');

            $absensiPerTanggal[] = Absensi::where('user_id', $user->id)
                ->whereDate('tanggal', $date)
                ->count();

            $logbookPerTanggal[] = Logbook::where('user_id', $user->id)
                ->whereDate('tanggal', $date)
                ->count();
        }

        // Ambil program kerja untuk dashboard (optional)
        $programKerjas = ProgramKerja::where('user_id', $user->id)->get();

        return view('dashboard.magang_dashboard', compact(
            'absensiHariIni',
            'logbookHariIni',
            'absensiPerBulan',
            'logbooksPerBulan',
            'tanggalBulanIni',
            'absensiPerTanggal',
            'logbookPerTanggal',
            'programKerjas'
        ));
    }

    // Absensi Masuk
public function absenMasuk(Request $request)
{
    $user = Auth::user();
    $today = Carbon::today();
    
    // Validasi input
    $validated = $request->validate([
        'keterangan' => 'required|in:Hadir,Izin'
    ]);
    
    $absensi = Absensi::firstOrNew([
        'user_id' => $user->id,
        'tanggal' => $today
    ]);
    
    // Jika sudah absen masuk
    if ($absensi->jam_masuk) {
        return back()->with('error', 'Anda sudah absen masuk hari ini.');
    }
    
    $absensi->jam_masuk = Carbon::now();
    $absensi->keterangan_masuk = $validated['keterangan'];  // Simpan di keterangan_masuk
    $absensi->save();
    
    return redirect()->route('magang.dashboard')->with('success', 'Absen masuk berhasil!');
}

// Absensi Keluar
public function absenKeluar(Request $request)
{
    $user = Auth::user();
    $today = Carbon::today();

    $absensi = Absensi::where('user_id', $user->id)
        ->whereDate('tanggal', $today)
        ->first();

    // Pastikan absen masuk sudah dilakukan
    if (!$absensi || !$absensi->jam_masuk) {
        return back()->with('error', 'Anda harus absen masuk terlebih dahulu.');
    }

    // Jika sudah absen keluar
    if ($absensi->jam_keluar) {
        return back()->with('error', 'Anda sudah absen keluar hari ini.');
    }

    // Validasi input untuk keterangan keluar (misal: Pulang atau Izin Pulang)
    $validated = $request->validate([
        'keterangan' => 'required|in:Pulang,Izin Pulang'
    ]);

    $absensi->jam_keluar = Carbon::now();
    $absensi->keterangan_keluar = $validated['keterangan'];  // Simpan di keterangan_keluar
    $absensi->save();

    return redirect()->route('magang.dashboard')->with('success', 'Absen keluar berhasil!');
}




    // Riwayat Harian Absensi
    public function riwayatHarian()
    {
        $absensi = Absensi::all()->map(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal);
            $item->jam_masuk = $item->jam_masuk ? Carbon::parse($item->jam_masuk) : null;
            $item->jam_keluar = $item->jam_keluar ? Carbon::parse($item->jam_keluar) : null;
            return $item;
        });

        return view('magang.riwayat_harian', compact('absensi'));
    }

    // Logbook
    public function logbook(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'aktivitas' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal' => 'required|date',
                'logbook_file' => 'nullable|file|mimes:pdf,docx|max:10240',
            ]);

            $logbookData = [
                'user_id' => $user->id,
                'aktivitas' => $validated['aktivitas'],
                'deskripsi' => $validated['deskripsi'],
                'tanggal' => $validated['tanggal'],
            ];

            // Simpan file jika ada
            if ($request->hasFile('logbook_file')) {
                $path = $request->file('logbook_file')->store('logbooks', 'public');
                $logbookData['file_path'] = $path;
            }

            Logbook::create($logbookData);

            return redirect()->route('magang.logbook')->with('success', 'Logbook berhasil disimpan!');
        }

        $logbooks = Logbook::where('user_id', $user->id)->get()->map(function ($logbook) {
            $logbook->tanggal = Carbon::parse($logbook->tanggal);
            return $logbook;
        });

        return view('magang.logbook', compact('logbooks'));
    }

    // Tampilkan form program kerja
    public function showProgramKerjaForm()
    {
        return view('magang.programkerja');
    }

    // Simpan program kerja
    public function storeProgramKerja(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);
    
        // Simpan program kerja
        $programKerja = new ProgramKerja();
        $programKerja->judul = $validated['judul'];
        $programKerja->deskripsi = $validated['deskripsi'];
        $programKerja->tanggal_mulai = $validated['tanggal_mulai'];
        $programKerja->tanggal_selesai = $validated['tanggal_selesai'];
        $programKerja->user_id = auth()->id();
        $programKerja->save();
    
        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('magang.dashboard')->with('success', 'Program Kerja berhasil disimpan!');
    }
    

    // Tampilkan program kerja
    public function showProgramKerja()
    {
        $programKerjas = ProgramKerja::where('user_id', Auth::id())->get();
        return view('magang.programkerja', compact('programKerjas'));
    }
}

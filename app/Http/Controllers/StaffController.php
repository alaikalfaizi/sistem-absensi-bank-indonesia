<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Logbook;
use Carbon\Carbon;

class StaffController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $tanggalHariIni = today();
    
        // Ambil absensi hari ini untuk user yang login
        $absensiHariIni = $this->getAbsensiHariIni($user, $tanggalHariIni);
    
        // Ambil logbook hari ini untuk user yang login
        $logbookHariIni = $this->getLogbookHariIni($user, $tanggalHariIni);
    
        // Ambil 5 logbook terakhir user login (termasuk hari ini)
        $logbooks = Logbook::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();
    
        // Ambil ID semua user yang dibawahi oleh staff ini
        $karyawanIds = $user->supervisedUsers->pluck('id');
    
        // Ambil absensi hari ini dari karyawan yang dibawahi
        $absensiKaryawan = $this->getAbsensiKaryawan($karyawanIds, $tanggalHariIni);
    
        // Ambil logbook hari ini dari karyawan yang dibawahi
        $logbookKaryawan = $this->getLogbookKaryawan($karyawanIds, $tanggalHariIni);
    
        return view('dashboard.staff_dashboard', compact(
            'absensiHariIni',
            'logbookHariIni',
            'logbooks',
            'absensiKaryawan',
            'logbookKaryawan'
        ));
    }
    
    

    // Ambil absensi hari ini untuk staff
    private function getAbsensiHariIni($user, $tanggal)
    {
        return $user->absensi()->whereDate('tanggal', $tanggal)->first();
    }

    // Ambil logbook hari ini untuk staff
    private function getLogbookHariIni($user, $tanggal)
    {
        return $user->logbook()->whereDate('tanggal', $tanggal)->first();
    }

    // Ambil absensi karyawan berdasarkan supervisor
    private function getAbsensiKaryawan($karyawanIds, $tanggal)
    {
        return Absensi::whereIn('user_id', $karyawanIds)->whereDate('tanggal', $tanggal)->get();
    }

    // Ambil logbook karyawan berdasarkan supervisor
    private function getLogbookKaryawan($karyawanIds, $tanggal)
    {
        return Logbook::whereIn('user_id', $karyawanIds)->whereDate('tanggal', $tanggal)->get();
    }

    // Absen Masuk
    public function absenMasuk(Request $request)
    {
        $user = auth()->user();
        $jamSekarang = Carbon::now('Asia/Jakarta');
        
        // Pastikan user belum absen masuk
        if ($this->userAlreadyAbsen($user)) {
            return back()->with('error', 'Sudah melakukan absen masuk hari ini.');
        }
    
        // Default status hadir, jika izin bisa memilih 'Izin'
        $status = $request->input('status', 'Hadir'); 
        $keterangan = $status === 'Izin' ? 'Izin' : $this->getKeterangan($jamSekarang);
    
        // Simpan absensi masuk
        Absensi::create([
            'user_id' => $user->id,
            'tanggal' => today(),
            'jam_masuk' => $status === 'Izin' ? null : $jamSekarang->toDateTimeString(),
            'status' => $status,
            'keterangan' => $keterangan
        ]);
    
        return redirect()->back()->with('success', 'Absen Masuk berhasil disimpan.');
    }
    
    public function absenKeluar(Request $request)
    {
        $user = auth()->user();
        $status = $request->input('status', 'Pulang'); // default Pulang
        $keterangan = $status === 'Izin Pulang' ? 'Izin Pulang' : 'Pulang';
    
        // Cari absensi hari ini
        $absensiMasuk = Absensi::where('user_id', $user->id)
            ->where('tanggal', today())
            ->whereNotNull('jam_masuk') // Pastikan sudah absen masuk
            ->first();
    
        if (!$absensiMasuk) {
            return back()->with('error', 'Anda belum absen masuk hari ini.');
        }
    
        // Update absensi keluar jika sudah ada absensi masuk
        $absensiMasuk->update([
            'jam_keluar' => $status === 'Izin Pulang' ? null : Carbon::now('Asia/Jakarta')->toDateTimeString(),
            'status' => $status,
            'keterangan' => $keterangan,
        ]);
    
        return redirect()->back()->with('success', 'Absen Keluar berhasil disimpan.');
    }
    



    // Simpan Logbook Pribadi
    public function storeLogbook(Request $request)
    {
        $this->validateLogbook($request);

        Logbook::create([
            'user_id' => auth()->id(),
            'aktivitas' => $request->aktivitas,
            'deskripsi' => $request->deskripsi,
            'tanggal' => today(),
        ]);

        return back()->with('success', 'Logbook berhasil disimpan.');
    }

    // Simpan Logbook Manual
    public function storeLogbookManual(Request $request)
    {
        $this->validateLogbook($request);

        $this->authorizeLogbook($request->user_id);

        Logbook::create($request->only('user_id', 'tanggal', 'aktivitas', 'deskripsi'));

        return back()->with('success', 'Logbook berhasil ditambahkan.');
    }

    // Validasi Logbook
    private function validateLogbook($request)
    {
        $request->validate([
            'aktivitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);
    }

    // Verifikasi apakah supervisor dapat menambah logbook untuk karyawan
    private function authorizeLogbook($userId)
    {
        $user = auth()->user();
        if (!$user->supervisedUsers->where('id', $userId)->exists()) {
            abort(403, 'Anda tidak memiliki izin untuk menambahkan logbook untuk karyawan ini.');
        }
    }

    // Mendapatkan keterangan berdasarkan waktu
    private function getKeterangan($jamSekarang)
    {
        $jamBatas = Carbon::createFromTime(8, 0, 0);
        return $jamSekarang->gt($jamBatas) ? 'Terlambat' : 'Tepat Waktu';
    }

    // Cek apakah user sudah absen
    private function userAlreadyAbsen($user)
    {
        return Absensi::where('user_id', $user->id)->whereDate('tanggal', today())->exists();
    }

    // Data Karyawan
public function dataKaryawan()
{
    $karyawans = User::where('role', 'karyawan')->get();
    return view('staff.data_karyawan', compact('karyawans'));
}

public function riwayatHarianPribadi()
{
    $user = auth()->user();
    $tanggalHariIni = today()->toDateString();

    // Ambil Absensi Masuk dan Keluar
    $absensiMasuk = Absensi::where('user_id', $user->id)
        ->where('tanggal', $tanggalHariIni)
        ->whereNotNull('jam_masuk')
        ->first();
        
    $absensiKeluar = Absensi::where('user_id', $user->id)
        ->where('tanggal', $tanggalHariIni) 
        ->whereNotNull('jam_keluar')
        ->first();

    // Ambil Logbook Hari Ini
    $logbook = Logbook::where('user_id', $user->id)
        ->where('tanggal', $tanggalHariIni)
        ->first();

    // Ambil 10 Logbook Terakhir
    $logbooksTerakhir = Logbook::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

    // Mengubah format waktu menggunakan Carbon di Controller
    $absensiMasukJam = $absensiMasuk ? Carbon::parse($absensiMasuk->jam_masuk)->timezone('Asia/Jakarta')->format('H:i:s') : '-';
    $absensiKeluarJam = $absensiKeluar ? Carbon::parse($absensiKeluar->jam_keluar)->timezone('Asia/Jakarta')->format('H:i:s') : '-';
    $logbookJam = $logbook ? Carbon::parse($logbook->created_at)->timezone('Asia/Jakarta')->format('H:i:s') : '-';

    return view('staff.riwayat_pribadi', compact(
        'absensiMasuk', 
        'absensiKeluar', 
        'logbook', 
        'logbooksTerakhir', 
        'absensiMasukJam', 
        'absensiKeluarJam', 
        'logbookJam'
    ));
}




public function riwayatHarianKaryawan(Request $request)
{
    $tanggal = $request->input('tanggal', today()->toDateString());
    $karyawanId = $request->input('user_id'); // id dari magang yang dipilih

    // Ambil semua user magang untuk ditampilkan di dropdown
    $magangUsers = User::where('role', 'magang')->get();

    $absensi = null;
    $logbook = null;

    // Jika ada karyawan dipilih, ambil absensi & logbook-nya
    if ($karyawanId) {
        $absensi = Absensi::where('user_id', $karyawanId)
            ->where('tanggal', $tanggal)
            ->first();

        $logbook = Logbook::where('user_id', $karyawanId)
            ->where('tanggal', $tanggal)
            ->first();
    }

    return view('staff.riwayat_karyawan_harian', compact(
        'magangUsers',
        'absensi',
        'logbook',
        'tanggal',
        'karyawanId'
    ));
}




public function riwayatGlobal(Request $request)
{
    $user = auth()->user();
    
    // Ambil data absensi global untuk seluruh karyawan
    $absensi = Absensi::with('user')
        ->whereDate('tanggal', today())
        ->get();

    // Ambil data logbook global untuk seluruh karyawan
    $logbook = Logbook::with('user')
        ->whereDate('tanggal', today())
        ->get(); // Ini sudah benar untuk mengambil semua logbook hari ini

    // Kirim data ke view
    return view('staff.riwayat_global', compact('absensi', 'logbook'));
}




}
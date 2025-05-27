<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function absenMasuk(Request $request)
    {
        // Validasi keterangan masuk (Hadir atau Izin)
        $request->validate([
            'keterangan_masuk' => 'nullable|in:Hadir,Izin', // Validasi keterangan masuk hanya bisa 'Hadir' atau 'Izin'
        ]);

        $karyawanId = Auth::id(); // Ambil ID pengguna yang login
        $tanggalHariIni = Carbon::now()->toDateString(); // Ambil tanggal hari ini

        // Cek apakah sudah ada absensi masuk untuk hari ini
        $existing = Absensi::where('user_id', $karyawanId)
                    ->where('tanggal', $tanggalHariIni)
                    ->first();

        // Jika sudah absen masuk
        if ($existing && $existing->jam_masuk) {
            return back()->with('error', 'Kamu sudah absen masuk hari ini.');
        }

        // Jika ada data absensi, update jam masuk dan keterangan masuk
        if ($existing) {
            $existing->update([
                'jam_masuk' => Carbon::now(),
                'status' => 'Hadir',  // Status 'Hadir' saat absen masuk
                'keterangan_masuk' => $request->keterangan_masuk ?? 'Hadir', // Simpan keterangan masuk
            ]);
        } else {
            // Jika belum ada data, buat absensi baru
            Absensi::create([
                'user_id' => $karyawanId,
                'tanggal' => $tanggalHariIni,
                'jam_masuk' => Carbon::now(),
                'status' => 'Hadir',
                'keterangan_masuk' => $request->keterangan_masuk ?? 'Hadir', // Keterangan masuk
            ]);
        }

        return back()->with('success', 'Absen masuk berhasil.');
    }

    public function absenKeluar(Request $request)
    {
        // Validasi keterangan keluar (Pulang atau Pulang Terlambat)
        $request->validate([
            'keterangan_keluar' => 'nullable|in:Pulang,Pulang Terlambat', // Validasi keterangan keluar hanya bisa 'Pulang' atau 'Pulang Terlambat'
        ]);

        $karyawanId = Auth::id(); // Ambil ID pengguna yang login
        $tanggalHariIni = Carbon::now()->toDateString(); // Ambil tanggal hari ini

        // Cek apakah absensi masuk sudah ada
        $absen = Absensi::where('user_id', $karyawanId)
                        ->where('tanggal', $tanggalHariIni)
                        ->first();

        // Jika belum absen masuk
        if (!$absen || !$absen->jam_masuk) {
            return back()->with('error', 'Kamu belum absen masuk hari ini.');
        }

        // Jika sudah absen keluar
        if ($absen->jam_keluar) {
            return back()->with('error', 'Kamu sudah absen keluar hari ini.');
        }

        // Update absensi keluar dan keterangan keluar
        $absen->update([
            'jam_keluar' => Carbon::now(),
            'status' => 'Pulang', // Status 'Pulang' saat absen keluar
            'keterangan_keluar' => $request->keterangan_keluar ?? 'Pulang', // Simpan keterangan keluar
        ]);

        return back()->with('success', 'Absen keluar berhasil.');
    }
}

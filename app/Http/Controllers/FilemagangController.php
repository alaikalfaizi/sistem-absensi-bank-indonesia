<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarMagang;

class FilemagangController extends Controller
{
    // Menampilkan form pendaftaran magang
    public function showForm()
    {
        $jumlahPendaftar = PendaftarMagang::count();
        $kuota = 999; // Misalnya kuota yang tersedia
    
        // Mengambil triwulan berdasarkan bulan pendaftaran
        $pendaftarMagang = PendaftarMagang::all()->map(function ($pendaftar) {
            $bulan = $pendaftar->tanggal_pendaftaran ? \Carbon\Carbon::parse($pendaftar->tanggal_pendaftaran)->month : null;
            $triWulan = '';
    
            if ($bulan >= 1 && $bulan <= 3) {
                $triWulan = 'Triwulan 1';
            } elseif ($bulan >= 4 && $bulan <= 6) {
                $triWulan = 'Triwulan 2';
            } elseif ($bulan >= 7 && $bulan <= 9) {
                $triWulan = 'Triwulan 3';
            } elseif ($bulan >= 10 && $bulan <= 12) {
                $triWulan = 'Triwulan 4';
            }
    
            $pendaftar->triwulan = $triWulan; // Menambahkan informasi triwulan
            return $pendaftar;
        });
    
        return view('magang.form_pendaftaran', compact('jumlahPendaftar', 'kuota', 'pendaftarMagang'));
    }
    

    // Menangani pengiriman form
    public function submitForm(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'domisili' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'asal_universitas' => 'required|string|max:255',
            'asal_jurusan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'keahlian' => 'required|string',
            'link_portofolio' => 'nullable|url',
            'berkas' => 'required|file|mimes:zip|max:10240', // 10 MB
        ]);

        // Proses upload file
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('berkas_magang', $filename, 'public');
        }

        $tanggalPendaftaran = now();


        // Simpan ke database
        PendaftarMagang::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'domisili' => $validated['domisili'],
            'no_hp' => $validated['no_hp'],
            'asal_universitas' => $validated['asal_universitas'],
            'asal_jurusan' => $validated['asal_jurusan'],
            'unit_kerja' => $validated['unit_kerja'],
            'keahlian' => $validated['keahlian'],
            'link_portofolio' => $validated['link_portofolio'], // Bisa null
            'berkas' => isset($filename) ? $filename : null,
            'tanggal_pendaftaran' => $tanggalPendaftaran,

        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim!');
    }
}

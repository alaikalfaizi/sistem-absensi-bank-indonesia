<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        // Ambil data berdasarkan bulan yang dipilih
        $bulan = $this->bulan;
        $start = \Carbon\Carbon::parse($bulan . '-01')->startOfMonth();
        $end = \Carbon\Carbon::parse($bulan . '-01')->endOfMonth();

        $data = [];
        
        // Ambil semua user dengan role 'magang' dan rekap absensi + logbook
        $semuaKaryawan = User::where('role', 'magang')->get();

        foreach ($semuaKaryawan as $karyawan) {
            $data[] = [
                'Nama' => $karyawan->name,
                'Jumlah Absensi' => Absensi::where('user_id', $karyawan->id)
                    ->whereBetween('tanggal', [$start, $end])
                    ->count(),
                'Jumlah Logbook' => Logbook::where('user_id', $karyawan->id)
                    ->whereBetween('tanggal', [$start, $end])
                    ->count(),
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Jumlah Absensi',
            'Jumlah Logbook',
        ];
    }
}

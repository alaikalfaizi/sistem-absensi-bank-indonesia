<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbsensiExport implements FromCollection
{
    /**
     * Mengambil data absensi untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Absensi::all(); // Ambil semua data absensi
    }
}

<?php

namespace App\Exports;

use App\Models\ProgramKerja;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProgramKerjaExport implements FromCollection
{
    /**
     * Mengambil data program kerja untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProgramKerja::all(); // Ambil semua data program kerja
    }
}


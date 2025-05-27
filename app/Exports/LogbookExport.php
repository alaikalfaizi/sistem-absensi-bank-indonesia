<?php

namespace App\Exports;

use App\Models\Logbook;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogbookExport implements FromCollection
{
    /**
     * Mengambil data logbook untuk diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Logbook::all(); // Ambil semua data logbook
    }
}

<?php

use App\Models\Absensi;
use App\Models\Logbook;
use App\Models\User;
use Carbon\Carbon;

class RiwayatController extends Controller
{
    public function staff()
    {
        $tanggal = Carbon::today();
        $riwayat = User::where('role', 'staff')->with([
            'absensi' => fn($q) => $q->where('tanggal', $tanggal),
            'logbook' => fn($q) => $q->where('tanggal', $tanggal),
        ])->get();

        return view('staff.riwayatstaff', compact('riwayat', 'tanggal'));
    }

    public function karyawan()
    {
        $tanggal = Carbon::today();
        $riwayat = User::where('role', 'karyawan')->with([
            'absensi' => fn($q) => $q->where('tanggal', $tanggal),
            'logbook' => fn($q) => $q->where('tanggal', $tanggal),
        ])->get();

        return view('staff.riwayatkaryawan', compact('riwayat', 'tanggal'));
    }
}

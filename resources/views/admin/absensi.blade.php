@extends('layouts.app') {{-- Sesuaikan dengan layout utama kamu --}}

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Rekap Absensi Staff dan Magang</h3>

    <!-- Form untuk Export Excel -->
    <form method="GET" action="{{ route('admin.exportAbsensi') }}" class="mb-4">
        <button type="submit" class="btn btn-success">Export ke Excel</button>
    </form>

    <!-- Tabel untuk Absensi Staff (Supervisor) -->
    <h4 class="mt-4 mb-3">Absensi Staff (Supervisor)</h4>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absensiStaff as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>{{ $absen->tanggal }}</td>
                    <td>{{ $absen->jam_masuk ?? '-' }}</td>
                    <td>{{ $absen->jam_keluar ?? '-' }}</td>
                    <td>{{ $absen->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada absensi hari ini untuk staff.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel untuk Absensi Magang -->
    <h4 class="mt-4 mb-3">Absensi Magang</h4>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absensiMagang as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>{{ $absen->tanggal }}</td>
                    <td>{{ $absen->jam_masuk ?? '-' }}</td>
                    <td>{{ $absen->jam_keluar ?? '-' }}</td>
                    <td>{{ $absen->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada absensi hari ini untuk magang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection

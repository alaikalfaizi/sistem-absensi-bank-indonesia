@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 mt-5 font-weight-bold">Riwayat Global Absensi & Logbook</h3>

    <!-- Data Absensi -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-primary text-white">Data Absensi</div>
        <div class="card-body masuk" style="overflow-x: auto;">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Keterangan Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Keterangan Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $a)
                    <tr>
    <td>{{ $a->user->name ?? '-' }}</td>
    <td>{{ $a->tanggal }}</td>
    <td>{{ $a->jam_masuk ?? '-' }}</td>
    <td>{{ $a->keterangan_masuk ?? 'Hadir' }}</td>
    <td>{{ $a->jam_keluar ?? '-' }}</td>
    <td>
        @if ($a->jam_keluar)
            {{ $a->keterangan_keluar ?? 'Pulang' }}
        @else
            -
        @endif
    </td>
</tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data absensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Data Logbook -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-primary text-white">Data Logbook</div>
        <div class="card-body masuk" style="overflow-x: auto;">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logbook as $l)
                    <tr>
                        <td>{{ $l->user->name ?? '-' }}</td>
                        <td>{{ $l->tanggal }}</td>
                        <td>{{ $l->aktivitas }}</td>
                        <td>{{ $l->deskripsi ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data logbook.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

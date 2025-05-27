@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 mt-5 font-weight-bold">Riwayat Harian Pribadi</h3>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Absensi Masuk --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-success text-white">Absensi Masuk</div>
        <div class="card-body masuk">
            @if ($absensiMasuk)
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Keterangan Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $absensiMasuk->tanggal }}</td>
                        <td>{{ $absensiMasukJam }}</td>
                        <td>{{ $absensiMasuk->keterangan_masuk ?? 'Hadir' }}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <p class="text-muted">Belum melakukan absen masuk hari ini.</p>
            @endif
        </div>
    </div>

    {{-- Absensi Keluar --}}
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-header bg-danger text-white">Absensi Keluar</div>
        <div class="card-body keluar">
            @if ($absensiKeluar)
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Keluar</th>
                        <th>Keterangan Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $absensiKeluar->tanggal }}</td>
                        <td>{{ $absensiKeluarJam }}</td>
                        <td>{{ $absensiKeluar->keterangan_keluar ?? 'Pulang' }}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <p class="text-muted">Belum melakukan absen keluar hari ini.</p>
            @endif
        </div>
    </div>

    <hr>

    <div class="row">
        {{-- Logbook Hari Ini --}}
        <div class="col-md-6 mb-4">
            <h3 class="font-weight-bold mb-4 mt-2">Logbook Hari Ini</h3>
            @if ($logbook)
            <ul class="list-group">
                <li class="list-group-item p-3">
                    <h5><strong>{{ $logbook->aktivitas }}</strong> - {{ $logbook->tanggal }}</h5>
                    <em class="mb-0">{{ $logbook->deskripsi }}</em>
                    <p><strong>Jam:</strong> {{ $logbookJam }}</p>
                </li>
            </ul>
            @else
            <p class="text-muted">Belum ada logbook yang dicatat hari ini.</p>
            @endif
        </div>

        {{-- Logbook 10 Terakhir --}}
        <div class="col-md-6 mb-5">
            <div>
                <h3 class="font-weight-bold mb-4 mt-2">Logbook Terbaru</h3>
                @if ($logbooksTerakhir->isEmpty())
                <p class="text-muted">Belum ada logbook yang tercatat.</p>
                @else
                <ul class="list-group">
                    @foreach ($logbooksTerakhir as $log)
                    <li class="list-group-item">
                        <strong>{{ $log->aktivitas }}</strong> - {{ $log->tanggal }}<br>
                        <em>{{ $log->deskripsi }}</em><br>
                        <p><strong>Jam:</strong> {{ \Illuminate\Support\Facades\Date::parse($log->created_at)->timezone('Asia/Jakarta')->format('H:i:s') }}</p>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

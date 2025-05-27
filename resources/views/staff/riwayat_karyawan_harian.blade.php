@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <h3 class="mb-4 mt-5 font-weight-bold">Riwayat Harian Magang - {{ $tanggal }}</h3>

    <form method="GET" action="{{ route('staff.riwayat.karyawan.harian') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-4">
            <label for="user_id" class="form-label">Pilih Karyawan</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach($magangUsers as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" class="form-control" required>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Lihat Riwayat</button>
        </div>
    </form>

    @if($absensi || $logbook)
    <div class="card bg-warning mb-4">
        <div class="card-header text-center">
            <h3 class="text-white font-weight-bold py-3">Absensi</h3>
        </div>
        <div class="card-body">
            @if ($absensi)
            <div class="mb-3 item-proker rounded p-3">
                <p><strong>Jam Masuk :</strong> {{ $absensi->jam_masuk ?? '-' }}</p>
                <p><strong>Jam Keluar :</strong> {{ $absensi->jam_keluar ?? '-' }}</p>
                <p><strong>Keterangan :</strong> {{ $absensi->keterangan ?? '-' }}</p>
            </div>
            @else
            <p class="text-muted">Tidak ada data absensi</p>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h3 class="text-white font-weight-bold py-3">Logbook</h3>
        </div>
        <div class="card-body">
            @if ($logbook)
            <div class="mb-3 item-proker rounded p-3">
                <h5><strong>{{ $logbook->aktivitas }}</strong></h5>
                <em>{{ $logbook->deskripsi }}</em>
            </div>
            @else
            <p class="text-muted">Tidak ada data logbook</p>
            @endif
        </div>
    </div>
    @elseif($karyawanId)
    <div class="alert alert-warning">Tidak ditemukan data untuk tanggal tersebut.</div>
    @endif
</div>
@endsection
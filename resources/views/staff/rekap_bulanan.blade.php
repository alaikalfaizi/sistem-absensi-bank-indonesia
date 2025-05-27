@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rekap Bulanan</h2>

    <form method="GET" class="mb-4">
        <label for="bulan" class="form-label">Pilih Bulan</label>
        <input type="month" name="bulan" id="bulan" class="form-control" value="{{ request('bulan') }}">
        <button type="submit" class="btn btn-primary mt-2">Tampilkan</button>
    </form>

    @php
        // Menentukan bulan yang dipilih, jika kosong akan menggunakan bulan pertama
        $bulanTerpilih = request('bulan') ?? $bulanList->first();
    @endphp

    @if(!empty($rekap[$bulanTerpilih]) && count($rekap[$bulanTerpilih]) > 0)
    <div class="table-responsive">
        <h5>Data untuk bulan {{ \Carbon\Carbon::parse($bulanTerpilih)->translatedFormat('F Y') }}</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jumlah Hadir</th>
                    <th>Jumlah Logbook</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semuaKaryawan as $kar) <!-- Menggunakan $semuaKaryawan di sini -->
                    @php
                        // Pastikan data tersedia, jika tidak ada set default
                        $data = $rekap[$bulanTerpilih][$kar->id] ?? ['absensi' => 0, 'logbook' => 0];
                    @endphp
                    <tr>
                        <td>{{ $kar->name }}</td>
                        <td>{{ $data['absensi'] }}</td>
                        <td>{{ $data['logbook'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info">
            Tidak ada data untuk bulan yang dipilih.
        </div>
    @endif
</div>
@endsection

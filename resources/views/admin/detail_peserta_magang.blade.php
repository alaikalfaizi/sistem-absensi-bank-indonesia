@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="font-weight-bold mb-4 mt-5">Detail Peserta Magang</h3>

    <!-- Tampilkan data peserta magang -->
    <table class="table table-striped">
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $pendaftar->nama }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $pendaftar->email }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $pendaftar->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Domisili</th>
            <td>{{ $pendaftar->domisili }}</td>
        </tr>
        <tr>
            <th>No. HP</th>
            <td>{{ $pendaftar->no_hp }}</td>
        </tr>
        <tr>
            <th>Universitas</th>
            <td>{{ $pendaftar->asal_universitas }}</td>
        </tr>
        <tr>
            <th>Jurusan</th>
            <td>{{ $pendaftar->asal_jurusan }}</td>
        </tr>
        <tr>
            <th>Unit Kerja</th>
            <td>{{ $pendaftar->unit_kerja }}</td>
        </tr>
        <tr>
            <th>Keahlian</th>
            <td>{{ $pendaftar->keahlian }}</td>
        </tr>
        <tr>
            <th>Link Portofolio</th>
            <td><a href="{{ $pendaftar->link_portofolio }}" target="_blank">{{ $pendaftar->link_portofolio }}</a></td>
        </tr>
        <tr>
            <th>Link Berkas</th>
            <td><a href="{{ $pendaftar->berkas }}" target="_blank">{{ $pendaftar->berkas }}</a></td>
        </tr>
        <!-- Menambahkan baris untuk menampilkan Triwulan -->
        <tr>
            <th>Triwulan</th>
            <td>
                @php
                    $bulan = \Carbon\Carbon::parse($pendaftar->tanggal_pendaftaran)->month;
                    $triWulan = '';

                    if ($bulan >= 1 && $bulan <= 3) {
                        $triWulan = 'Triwulan 1';
                    } elseif ($bulan >= 4 && $bulan <= 6) {
                        $triWulan = 'Triwulan 2';
                    } elseif ($bulan >= 7 && $bulan <= 9) {
                        $triWulan = 'Triwulan 3';
                    } elseif ($bulan >= 10 && $bulan <= 12) {
                        $triWulan = 'Triwulan 4';
                    }
                @endphp
                {{ $triWulan }}
            </td>
        </tr>
    </table>

    <a href="{{ route('admin.peserta_magang') }}" class="btn btn-secondary mt-3 mb-5">Kembali ke Daftar Peserta Magang</a>
</div>
@endsection

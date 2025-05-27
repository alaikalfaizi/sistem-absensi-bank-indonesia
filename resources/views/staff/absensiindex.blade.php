@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Absensi Karyawan</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiList as $absen)
                <tr>
                    <td>{{ $absen->user->name }}</td>
                    <td>{{ $absen->created_at->format('d M Y') }}</td>
                    <td>{{ $absen->jam_masuk }}</td>
                    <td>{{ $absen->jam_keluar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

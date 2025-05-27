@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Absensi</h2>
    <table class="table table-bordered">
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
            @foreach ($absensi as $absen)
            <tr>
                <td>{{ $absen->karyawan->name ?? '-' }}</td>
                <td>{{ $absen->tanggal }}</td>
                <td>{{ $absen->jam_masuk }}</td>
                <td>{{ $absen->jam_keluar }}</td>
                <td>{{ $absen->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $absensi->links() }}
</div>
@endsection

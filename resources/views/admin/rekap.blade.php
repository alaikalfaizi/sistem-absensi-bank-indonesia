@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Rekap Pengguna Bulanan</h3>

    <table class="table mt-4 table-bordered">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Jumlah Karyawan</th>
                <th>Jumlah Staff</th>
                <th>Jumlah Absensi</th>
                <th>Jumlah Logbook</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $bulan => $data)
                <tr>
                    <td>{{ $bulan }}</td>
                    <td>{{ $data['karyawan'] }}</td>
                    <td>{{ $data['staff'] }}</td>
                    <td>{{ $data['absensi'] }}</td>
                    <td>{{ $data['logbook'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

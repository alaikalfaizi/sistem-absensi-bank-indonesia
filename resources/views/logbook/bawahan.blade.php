@extends('layouts.app')

@section('content')
    <h2>Logbook Karyawan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Aktivitas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logbooks as $logbook)
                <tr>
                    <td>{{ $logbook->user->name }}</td>
                    <td>{{ $logbook->tanggal }}</td>
                    <td>{{ $logbook->aktivitas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

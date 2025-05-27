@extends('layouts.app')
@php use Carbon\Carbon; @endphp

@section('content')
<div class="container mt-4">
<h3>Riwayat Harian Staff - {{ Carbon::parse($tanggal)->format('d M Y') }}</h3>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Aktivitas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->absensi->first()->jam_masuk ?? '-' }}</td>
                    <td>{{ $user->absensi->first()->jam_keluar ?? '-' }}</td>
                    <td>{{ $user->logbook->first()->aktivitas ?? '-' }}</td>
                    <td>{{ $user->logbook->first()->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

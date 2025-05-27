@extends('layouts.app') {{-- Ganti sesuai layout kamu --}}
@section('content')
<div class="container">

    {{-- Notifikasi Success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Rekap Harian - {{ date('d M Y') }}</h2>

    <div class="card mb-3">
        <div class="card-header">Informasi Absen</div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Jam Masuk:</strong> {{ $absenMasuk ?? '-' }}</p>
            <p><strong>Jam Keluar:</strong> {{ $absenKeluar ?? '-' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Logbook Hari Ini</div>
        <div class="card-body">
            <p><strong>Aktivitas:</strong> {{ $logbook->aktivitas ?? 'Belum ada aktivitas' }}</p>
        </div>
    </div>

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Statistik --}}
    <div class="row mb-4 mt-5">
        <div class="col-md-3">
            <div class="card text-bg-primary text-center mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Peserta Magang</h5>
                    <p class="card-text fs-4">{{ $jumlahKaryawan }}</p>
                </div>
                <div class="card-footer text-white text-center">
                    <small>Jumlah Akun Magang Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-primary text-center mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Supervisor</h5>
                    <p class="card-text fs-4">{{ $jumlahStaff }}</p>
                </div>
                <div class="card-footer text-white text-center">
                    <small>Jumlah Akun Supervisor Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-primary text-center mb-3">
                <div class="card-body">
                    <h5 class="card-title">Data Absensi</h5>
                    <p class="card-text fs-4">{{ $jumlahAbsensi }}</p>
                </div>
                <div class="card-footer text-white text-center">
                    <small>Total Data Absensi Tersimpan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-primary text-center mb-3">
                <div class="card-body">
                    <h5 class="card-title">Data Logbook</h5>
                    <p class="card-text fs-4">{{ $jumlahLogbook }}</p>
                </div>
                <div class="card-footer text-white text-center">
                    <small>Total Data Logbook Tersimpan</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Daftar User --}}
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <a href="{{ route('admin.register') }}" class="w-50 btn btn-primary mt-3">Daftarkan User Baru</a>
        </div>
    </div>

    {{-- Data Hari Ini --}}
    <div class="row">
        {{-- Absensi Hari Ini --}}
        <div class="col-md-6 mb-4">
            <h3 class="font-weight-bold mb-4 mt-2">Absensi Terbaru</h3>
            @if($absensiHariIni->isEmpty())
                <p class="text-muted">Belum ada absensi hari ini.</p>
            @else
                <ul class="list-group">
                    @foreach($absensiHariIni as $absen)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $absen->user->name ?? 'Nama tidak ditemukan' }}</strong><br>
                                <small>Tanggal : {{ $absen->tanggal }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">Masuk : {{ $absen->jam_masuk ?? '-' }}</span><br>
                                <span class="badge bg-danger">Keluar : {{ $absen->jam_keluar ?? '-' }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Logbook Hari Ini --}}
        <div class="col-md-6 mb-4">
            <h3 class="font-weight-bold mb-4 mt-2">Logbook Hari Ini</h3>
            @if($logbookHariIni->isEmpty())
                <p class="text-muted">Belum ada logbook hari ini.</p>
            @else
                <ul class="list-group">
                    @foreach($logbookHariIni as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->user->name ?? 'Nama tidak ditemukan' }}</strong><br>
                            <span class="text-muted">{{ $log->aktivitas }}</span><br>
                            <small class="text-secondary">Jam : {{ \Illuminate\Support\Str::limit($log->created_at, 19, '') }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Logbook Terbaru --}}
    <div class="row mb-5">
        <div class="col-md-12">
            <h3 class="font-weight-bold mb-4 mt-2">Logbook Terbaru</h3>
            @if($logbooks->isEmpty())
                <p class="text-muted">Belum ada logbook yang tercatat.</p>
            @else
                <ul class="list-group">
                    @foreach($logbooks as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->user->name ?? 'Nama tidak ditemukan' }}</strong><br>
                            <span class="text-muted">{{ $log->aktivitas }}</span><br>
                            <small>{{ $log->tanggal }} | Jam : {{ \Illuminate\Support\Str::limit($log->created_at, 19, '') }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Animate.css for animation -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@if(session('success'))
<script>
  Swal.fire({
    title: '🎉 Sukses Login!',
    html: `<strong>{{ session('success') }}</strong><br>Selamat datang di dashboard.`,
    icon: 'success',
    iconColor: '#ffffff',
    background: '#28a745',
    color: '#e9f7ef',
    confirmButtonText: 'Oke, Siap!',
    confirmButtonColor: '#19692c',
    timer: 7000,
    timerProgressBar: true,
    showClass: {
      popup: 'animate__animated animate__bounceInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    },
    backdrop: `
      rgba(40, 167, 69, 0.4)
      url("https://media.giphy.com/media/111ebonMs90YLu/giphy.gif")
      center center
      no-repeat
    `
  });
</script>
@endif

@endsection



@extends('layouts.app')

@section('content')

<div class="container mb-5">

    {{-- Status Absensi dan Logbook --}}
    <div class="row mt-5">
        <div class="col-md-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5>Absensi</h5>
                    <p>{{ $absensiHariIni && $absensiHariIni->jam_masuk ? '✅ Sudah Absen Masuk' : '❌ Belum Absen Masuk' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5>Logbook</h5>
                    <p>{{ $logbookHariIni ? '✅ Sudah Diisi' : '❌ Belum Diisi' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Absen Masuk & Keluar --}}
    <div class="row mb-3 text-center">
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-success text-white">Absen Masuk</div>
                <div class="card-body masuk">
                    <form action="{{ route('staff.absensi.masuk') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-select mt-1 mb-3 text-center" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                            </select>
                            <small class="text-muted">Absen Masuk ditutup jam 08:00</small>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Absen Masuk</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-danger text-white">Absen Keluar</div>
                <div class="card-body keluar">
                    <form action="{{ route('staff.absensi.keluar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" class="form-select mt-1 mb-3 text-center" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Pulang">Pulang</option>
                                <option value="Izin Pulang">Izin Pulang</option>
                            </select>
                            <small class="text-muted">Absen Keluar dibuka jam 16:45</small>
                        </div>
                        <button type="submit" class="btn btn-danger">Simpan Absen Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Logbook Hari Ini --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="font-weight-bold mb-4">Logbook Hari Ini</h3>
            @if ($logbookHariIni)
            <table class="table table-sm table-bordered table-striped mb-5">
                <thead>
                    <th>Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                </thead>
                <tbody>
                    <td>{{ $logbookHariIni->aktivitas }}</td>
                    <td>{{ $logbookHariIni->deskripsi }}</td>
                    <td>{{ $logbookHariIni->tanggal }}</td>
                </tbody>
            </table>
            @else
            <p class="text-muted">Belum mengisi logbook hari ini</p>
            @endif
        </div>
    </div>

    <hr>

    {{-- Tambah Logbook --}}
    <h3 class="font-weight-bold mb-4 mt-5">Tambah Logbook</h3>
    <form action="{{ route('staff.logbook.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3">
            <label for="aktivitas">Aktivitas</label>
            <input type="text" name="aktivitas" class="form-control mt-1" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control mt-1" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Logbook</button>
    </form>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Logbook Harian</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Logbook --}}
    <div class="card mb-4">
        <div class="card-header">Tambah Logbook Hari Ini</div>
        <div class="card-body">
            <form method="POST" action="{{ request()->is('staff/*') ? route('staff.logbook.store') : route('karyawan.logbook.store') }}">
                @csrf
                <div class="form-group">
                    <label for="aktivitas">Aktivitas:</label>
                    <textarea name="aktivitas" id="aktivitas" rows="3" class="form-control" required></textarea>
                    @error('aktivitas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Tabel Logbook --}}
    <div class="card">
        <div class="card-header">Riwayat Logbook</div>
        <div class="card-body">
            @if($logbooks->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logbooks as $logbook)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($logbook->tanggal)->format('d M Y') }}</td>
                                <td>{{ $logbook->aktivitas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada logbook yang ditambahkan.</p>
            @endif
        </div>
    </div>
</div>
@endsection

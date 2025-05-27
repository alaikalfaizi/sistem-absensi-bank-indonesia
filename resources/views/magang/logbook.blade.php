<!-- resources/views/magang/logbook.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">

    <h3 class="font-weight-bold mb-4 mt-5">Logbook</h3>

    <!-- Form pengisian logbook -->
    <form action="{{ route('magang.logbook') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="aktivitas">Aktivitas</label>
            <input type="text" name="aktivitas" id="aktivitas" class="form-control mt-1" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control mt-1" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control mt-1" required>
        </div>
        <button class="btn btn-primary w-40">Simpan Logbook</button>
    </form>

    <hr>

    <h3 class="font-weight-bold mb-4 mt-5">Riwayat Harian Logbook</h3>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-striped mb-5">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logbooks as $logbook)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $logbook->aktivitas }}</td>
                    <td>{{ $logbook->deskripsi }}</td>
                    <td class="col-2">{{ $logbook->tanggal->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
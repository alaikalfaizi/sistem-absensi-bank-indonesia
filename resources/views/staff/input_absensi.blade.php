@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Input Absensi Manual</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('staff.absensi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id">Pilih Karyawan</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jam_masuk">Jam Masuk</label>
            <input type="time" name="jam_masuk" class="form-control">
        </div>

        <div class="mb-3">
            <label for="jam_keluar">Jam Keluar</label>
            <input type="time" name="jam_keluar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Absensi</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Input Program Kerja</h3>

    {{-- Menampilkan pesan jika ada error --}}
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form class="mb-5" action="{{ route('magang.programkerja.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="judul">Nama Program:</label>
            <input type="text" id="judul" name="judul" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi Program Kerja:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Program Kerja</button>
    </form>
</div>
@endsection
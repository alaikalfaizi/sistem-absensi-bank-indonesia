@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Pengisian Logbook</h3>

    <form action="{{ route('karyawan.storelogbook') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="aktivitas">Aktivitas Hari Ini:</label>
            <textarea name="aktivitas" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Logbook</h2>

    <form action="{{ route('magang.storeLogbook') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="aktivitas">Aktivitas:</label>
            <input type="text" id="aktivitas" name="aktivitas" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Logbook</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Pendaftaran User Baru</h3>

    <form action="{{ route('admin.register.submit') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Pilih Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="magang">Magang</option>
            </select>
            @error('role')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary mb-5">Tambah User</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Karyawan di Bawah Staff</h3>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawanList as $karyawan)
                <tr>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

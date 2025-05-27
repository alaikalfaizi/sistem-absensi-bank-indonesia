@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 mt-5 font-weight-bold">Data Magang</h3>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->name }}</td>
                <td>{{ $karyawan->email }}</td>
                <td>{{ $karyawan->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

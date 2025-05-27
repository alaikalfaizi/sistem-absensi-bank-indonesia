@extends('layouts.app') {{-- atau layouts lain sesuai project kamu --}}

@section('content')
<div class="container">
    <h1>Data Magang</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $karyawan->name }}</td>
                    <td>{{ $karyawan->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
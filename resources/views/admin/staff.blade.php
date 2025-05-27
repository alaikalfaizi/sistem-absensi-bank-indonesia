@extends('layouts.app') {{-- atau layout lain kalau kamu pakai yang berbeda --}}

@section('content')
<div class="container">
    <h1>Data Staff</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staffs as $staff)
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

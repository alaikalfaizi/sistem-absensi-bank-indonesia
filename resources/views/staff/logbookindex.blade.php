@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Logbook Karyawan</h3>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Isi Logbook</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logbookList as $log)
                <tr>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->created_at->format('d M Y') }}</td>
                    <td>{{ $log->isi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

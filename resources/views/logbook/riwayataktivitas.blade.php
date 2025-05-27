@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Aktivitas Logbook</h3>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($logbooks->isEmpty())
        <p>Belum ada aktivitas yang tercatat.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logbooks as $log)
                    <tr>
                        <td>{{ $log->tanggal }}</td>
                        <td>{{ $log->aktivitas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Harian - Logbook dan Absensi</h3>

    @if($riwayat->isEmpty())
        <p>Belum ada data riwayat.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayat as $item)
                    <tr>
                        <td>{{ $item['tanggal'] }}</td>
                        <td>{{ $item['jam_masuk'] }}</td>
                        <td>{{ $item['jam_keluar'] }}</td>
                        <td>{{ $item['aktivitas'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

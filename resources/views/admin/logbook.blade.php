@extends('layouts.app') {{-- atau layout lain sesuai yang kamu pakai --}}

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Riwayat Logbook Staff dan Magang</h3>

    <!-- Form untuk Export Excel -->
    <form method="GET" action="{{ route('admin.exportLogbook') }}" class="mb-4">
        <button type="submit" class="btn btn-success">Export ke Excel</button>
    </form>

    <!-- Tabel untuk Logbook Staff -->
    <h4 class="mt-4 mb-3">Logbook Staff (Supervisor)</h4>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logbookStaff as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->aktivitas }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->tanggal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel untuk Logbook Magang -->
    <h4 class="mt-4 mb-3">Logbook Magang</h4>
    <div style="overflow-x: auto;">
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Aktivitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logbookMagang as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->aktivitas }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>{{ $item->tanggal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

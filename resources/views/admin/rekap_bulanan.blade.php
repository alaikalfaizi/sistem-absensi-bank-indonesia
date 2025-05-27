@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Rekap Absensi & Logbook Staff dan Magang</h3>

    <!-- Form untuk memilih bulan -->
    <form method="GET" action="{{ route('admin.rekap') }}" class="mb-4">
        <div class="form-group">
            <label for="bulan">Pilih Bulan :</label>
            <select name="bulan" id="bulan" class="form-control mt-2" onchange="this.form.submit()">
                @foreach ($bulanList as $itemBulan)
                    <option value="{{ $itemBulan }}" {{ $itemBulan == $bulan ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($itemBulan . '-01')->translatedFormat('F Y') }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Tombol Export Excel -->
    <form method="GET" action="{{ route('admin.exportRekap') }}" class="mb-4">
        <input type="hidden" name="bulan" value="{{ $bulan }}">
        <button type="submit" class="btn btn-success">Export ke Excel</button>
    </form>

    <!-- Tabel Rekap untuk Staff (Supervisor) -->
    <h5 class="mt-4 mb-3">A. Staff (Supervisor)</h5>
    <table class="table table-sm table-bordered table-striped mb-5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Absensi</th>
                <th>Jumlah Logbook</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semuaStaff as $staff)
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $rekap[$bulan]['staff'][$staff->id]['absensi'] ?? 0 }}</td>
                    <td>{{ $rekap[$bulan]['staff'][$staff->id]['logbook'] ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Rekap untuk Magang -->
    <h5 class="mt-4 mb-3">B. Magang</h5>
    <table class="table table-sm table-bordered table-striped mb-5">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Absensi</th>
                <th>Jumlah Logbook</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semuaMagang as $magang)
                <tr>
                    <td>{{ $magang->name }}</td>
                    <td>{{ $rekap[$bulan]['magang'][$magang->id]['absensi'] ?? 0 }}</td>
                    <td>{{ $rekap[$bulan]['magang'][$magang->id]['logbook'] ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

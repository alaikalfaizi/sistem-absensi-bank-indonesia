@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Riwayat Absen Pribadi</h3>

    <table class="table table-sm table-striped mb-5">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan Masuk</th>
                <th>Keterangan Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
                <tr>
                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $item->jam_masuk ? $item->jam_masuk->format('H:i:s') : '-' }}</td>
                    <td>{{ $item->jam_keluar ? $item->jam_keluar->format('H:i:s') : '-' }}</td>
                    
                    {{-- Keterangan Masuk --}}
                    <td>
                        @if($item->jam_masuk)
                            {{-- Menampilkan keterangan_masuk --}}
                            {{ $item->keterangan_masuk === 'Hadir' ? 'Hadir' : ($item->keterangan_masuk === 'Izin' ? 'Izin' : '-') }}
                        @else
                            -
                        @endif
                    </td>

                    {{-- Keterangan Keluar --}}
                    <td>
                        @if($item->jam_keluar)
                            {{-- Menampilkan keterangan_keluar --}}
                            {{ $item->keterangan_keluar === 'Pulang' ? 'Pulang' : ($item->keterangan_keluar === 'Izin Pulang' ? 'Izin Pulang' : '-') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

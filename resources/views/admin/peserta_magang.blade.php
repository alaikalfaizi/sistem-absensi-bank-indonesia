@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="font-weight-bold mb-4 mt-5">Calon Peserta Magang</h3>
    <div style="overflow-x: auto;">
        <!-- Tabel untuk menampilkan data peserta magang -->
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Universitas</th>
                    <th>Jurusan</th>
                    <th>Unit Kerja</th>
                    <th>Status</th>
                    <th>Triwulan</th> <!-- Kolom Triwulan baru -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertaMagang as $index => $pendaftar)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pendaftar->nama }}</td>
                    <td>{{ $pendaftar->email }}</td>
                    <td>{{ $pendaftar->asal_universitas }}</td>
                    <td>{{ $pendaftar->asal_jurusan }}</td>
                    <td>{{ $pendaftar->unit_kerja }}</td>
                    <td>
                        <!-- Form untuk memilih status -->
                        <form action="{{ route('admin.update_status', $pendaftar->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="Menunggu" {{ $pendaftar->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Proses" {{ $pendaftar->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Diterima" {{ $pendaftar->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ $pendaftar->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        @php
                            $bulan = \Carbon\Carbon::parse($pendaftar->tanggal_pendaftaran)->month;
                            $triWulan = '';

                            if ($bulan >= 1 && $bulan <= 3) {
                                $triWulan = 'Triwulan 1';
                            } elseif ($bulan >= 4 && $bulan <= 6) {
                                $triWulan = 'Triwulan 2';
                            } elseif ($bulan >= 7 && $bulan <= 9) {
                                $triWulan = 'Triwulan 3';
                            } elseif ($bulan >= 10 && $bulan <= 12) {
                                $triWulan = 'Triwulan 4';
                            }
                        @endphp
                        {{ $triWulan }}
                    </td>
                    <td>
                        <!-- Link untuk melihat detail peserta magang -->
                        <a href="{{ route('admin.peserta_magang.show', $pendaftar->id) }}" class="btn btn-login btn-sm mb-1">Lihat</a>
                        <!-- Link untuk melihat berkas -->
                        <a href="{{ asset('storage/berkas_magang/' . $pendaftar->berkas) }}" target="_blank" class="btn btn-login btn-sm">Lihat Berkas</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

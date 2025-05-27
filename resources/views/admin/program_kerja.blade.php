@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="font-weight-bold mb-4 mt-5">Program Kerja Magang</h3>

    <!-- Form untuk Export Excel -->
    <form method="GET" action="{{ route('admin.exportProgramKerja') }}" class="mb-4">
        <button type="submit" class="btn btn-success">Export ke Excel</button>
    </form>

    @if($programKerja->isEmpty())
        <p class="text-muted">Belum ada program kerja yang terdaftar.</p>
    @else
        <table class="table table-sm table-bordered table-striped mb-5">
            <thead>
                <tr>
                    <th>Nama</th>  <!-- Nama User -->
                    <th>Nama Program</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programKerja as $program)
                    <tr>
                        <td>{{ $program->user->name }}</td>  <!-- Nama Pengguna -->
                        <td>{{ $program->judul }}</td>
                        <td>{{ $program->deskripsi }}</td>
                        <td>{{ $program->tanggal_mulai }}</td>
                        <td>{{ $program->tanggal_selesai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

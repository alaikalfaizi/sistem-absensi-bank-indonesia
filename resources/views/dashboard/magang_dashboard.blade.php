    @extends('layouts.app')

    @section('content')
    <div class="container">

        {{-- Status Program Kerja --}}
        <div class="row mb-4 mt-5">
            <div class="col-md-12">
                <div class="card bg-warning">
                    <div class="card-header">
                        <h3 class="text-center text-white font-weight-bold py-3">📋 Program Kerja</h3>
                    </div>
                    <div class="card-body">
                        @if (!empty($programKerjas))
                            @foreach ($programKerjas as $program)
                            <div class="mb-3 item-proker p-3 rounded">
                                <h5><strong>{{ $program->judul }}</strong></h5>
                                <p class="mb-2">{{ $program->deskripsi }}</p>
                                <p class="mb-0">Tanggal Mulai : {{ \Carbon\Carbon::parse($program->tanggal_mulai)->format('d M Y') }}</p>
                                <p>Tanggal Selesai : {{ \Carbon\Carbon::parse($program->tanggal_selesai)->format('d M Y') }}</p>
                            </div>
                            @endforeach
                        @else
                            <p class="text-center mb-0">❌ Belum ada Program Kerja yang diinput</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Absensi dan Logbook --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5>Absensi</h5>
                        <p>
                            @if ($absensiHariIni)
                                @if ($absensiHariIni->keterangan === 'Izin')
                                    🟡 Izin
                                @elseif ($absensiHariIni->jam_masuk)
                                    ✅ Sudah Absen Masuk
                                @else
                                    ❌ Belum Absen Masuk
                                @endif
                            @else
                                ❌ Belum Absen Masuk
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h5>Logbook</h5>
                        <p>{{ $logbookHariIni ? '✅ Sudah Diisi' : '❌ Belum Diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Absen --}}
        <div class="row mb-5 text-center">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-success text-white">Absen Masuk</div>
                    <div class="card-body masuk">
                        <form action="{{ route('magang.absensi.masuk') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="mb-3">
                                <label for="keterangan">Keterangan</label>
                                <select name="keterangan" class="form-select mt-1 mb-3 text-center" required>
                                    <option value="">-- Pilih Keterangan --</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                </select>
                                <small class="text-muted">Absen Masuk ditutup jam 08:00</small>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Absen Masuk</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-danger text-white">Absen Keluar</div>
            <div class="card-body keluar">
                <form action="{{ route('magang.absensi.keluar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <select name="keterangan" class="form-select mt-1 mb-3 text-center" required>
                            <option value="">-- Pilih Keterangan --</option>
                            <option value="Pulang">Pulang</option>
                            <option value="Izin Pulang">Izin Pulang</option>
                        </select>
                        <small class="text-muted">Absen Keluar dibuka jam 16:45</small>
                    </div>
                    <button type="submit" class="btn btn-danger">Simpan Absen Keluar</button>
                </form>
            </div>
        </div>
    </div>

    </div>
    @endsection

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('logbookAbsensiChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($tanggalBulanIni) !!},
                    datasets: [
                        {
                            label: 'Absensi',
                            data: {!! json_encode($absensiPerTanggal) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        },
                        {
                            label: 'Logbook',
                            data: {!! json_encode($logbookPerTanggal) !!},
                            backgroundColor: 'rgba(255, 206, 86, 0.7)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    </script>
    @endsection

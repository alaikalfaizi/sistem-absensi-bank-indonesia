@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="font-weight-bold mt-5">Form Pendaftaran Magang</h3>

    <hr>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p style="color: #196896;">Jumlah pendaftar saat ini : <strong>{{ $jumlahPendaftar }}</strong> / Kuota : <strong>{{ $kuota }}</strong></p>

    <form id="formPendaftaran" action="{{ route('magang.submit') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Aktif</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="domisili" class="form-label">Domisili Saat Ini</label>
            <input type="text" class="form-control" id="domisili" name="domisili" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP Aktif</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>

        <div class="mb-3">
            <label for="asal_universitas" class="form-label">Asal Universitas</label>
            <input type="text" class="form-control" id="asal_universitas" name="asal_universitas" required>
        </div>

        <div class="mb-3">
            <label for="asal_jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="asal_jurusan" name="asal_jurusan" required>
        </div>

        <div class="mb-3">
            <label for="unit_kerja" class="form-label">Pilihan Unit Kerja yang Diminati</label>
            <select class="form-control" id="unit_kerja" name="unit_kerja" required>
                <option value="">-- Pilih Unit Kerja --</option>
                <option value="Fungsi Implementasi Pengawasan SP PUR">Fungsi Implementasi Pengawasan SP PUR</option>
                <option value="Fungsi Implementasi Kebijakan Sistem Pembayaran">Fungsi Implementasi Kebijakan Sistem Pembayaran</option>
                <option value="Tim Manajemen Intern">Tim Manajemen Intern</option>
                <option value="Fungsi Perumusan Kekda Provinsi">Fungsi Perumusan Kekda Provinsi</option>
                <option value="Fungsi Data Statistik Ekonomi Keuangan">Fungsi Data Statistik Ekonomi Keuangan</option>
                <option value="Unit Kehumasan">Unit Kehumasan</option>
                <option value="Fungsi Pelaksanaan Pengembangan UMKM, Keuangan Inklusi, dan Syariah">Fungsi Pelaksanaan Pengembangan UMKM, Keuangan Inklusi, dan Syariah</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian yang Dimiliki</label>
            <textarea class="form-control" id="keahlian" name="keahlian" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="link_portofolio" class="form-label">Portofolio Design (Link Google Drive) <span class="text-muted">(Opsional)</span></label>
            <input type="url" class="form-control" id="link_portofolio" name="link_portofolio" placeholder="https://drive.google.com/..." >
        </div>

        <div class="mb-3">
            <label for="berkas" class="form-label">Upload Berkas Persyaratan (.zip)</label>
            <input type="file" class="form-control" id="berkas" name="berkas" accept=".zip" required>
            <div class="form-text">
                Berkas berisi: CV, Motivation Letter, Keahlian/Prestasi (semua dalam satu file .zip)
            </div>
        </div>

        <button type="button" class="btn btn-success mb-5 mt-3" onclick="confirmSubmit()">Kirim Pendaftaran</button>
    </form>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmSubmit() {
        Swal.fire({
            title: 'Apakah kamu sudah yakin dengan pengisian form?',
            text: "Pastikan semua data yang kamu isi sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formPendaftaran').submit(); // Jika memilih "Lanjutkan"
            }
        });
    }
</script>

@endsection

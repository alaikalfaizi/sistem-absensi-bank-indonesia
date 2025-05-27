@extends('layouts.app')

@section('content')
<div class="container mb-5 info-magang">
    <h3 class="font-weight-bold mb-4 mt-5">Informasi Program Magang di Bank Indonesia</h3>

    <hr>

    <div>
        <h4 class="font-weight-bold mb-3">Pengantar</h4>
        <p>Program Magang (Internship) adalah program untuk memberikan wawasan dunia kerja sekaligus berlatih bekerja dan mengenalkan budaya kerja Bank Indonesia selama waktu tertentu sesuai dengan kebutuhan organisasi.</p>
    </div>

    <div>
        <p class="mb-3">Program Magang di Bank Indonesia meliputi:</p>
        <ul>
            <li><strong>Program Magang Kerja Sama</strong> - Program yang dilakukan berdasarkan nota kesepahaman dan/atau perjanjian Kerjasama antara Bank Indonesia dengan Lembaga, perguruan tinggi, dan atau Instansi lain. Contoh: Program Kampus Merdeka Bank Indonesia.</li>
            <li><strong>Program Magang Professional</strong> - Program yang diselenggarakan untuk menjaring talenta terbaik yang siap untuk bekerja bagi lulusan Perguruan Tinggi Dalam Negeri dan Luar Negeri.</li>
            <li><strong>Program Magang Pelajar dan Mahasiswa</strong> - Program yang diselenggarakan sebagai salah satu bentuk tanggung jawab sosial organisasi dengan memberikan kesempatan untuk berlatih bekerja kepada peserta Program Magang.</li>
        </ul>
    </div>

    <hr>

    <div>
        <h4 class="font-weight-bold mb-3 mt-4">Persyaratan Permohonan Magang (Internship)</h4>
        <div style="overflow-x: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Program Magang</th>
                        <th>Kerja Sama</th>
                        <th>Professional</th>
                        <th>Pelajar & Mahasiswa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jenjang</td>
                        <td>Sebagaimana MoU</td>
                        <td>D3/D4/S1/S2</td>
                        <td>SMK/SMA, D3/D4/S1, S2/S3</td>
                    </tr>
                    <tr>
                        <td>Tingkat Pendidikan</td>
                        <td>Sebagaimana MoU</td>
                        <td>Lulus Minimal</td>
                        <td>Kelas 2, Minimal Semester 4</td>
                    </tr>
                    <tr>
                        <td>Batas Waktu Pendaftaran</td>
                        <td>Sebagaimana MoU</td>
                        <td>Maksimal 1 tahun sejak tanggal ijazah</td>
                        <td>Sebagaimana Periode Penerimaan Pendaftaran</td>
                    </tr>
                    <tr>
                        <td>Jangka Waktu</td>
                        <td>Sebagaimana MoU</td>
                        <td>Min 1 bulan, Maks 1 tahun</td>
                        <td>Min 1 bulan, Maks 6 bulan</td>
                    </tr>
                    <tr>
                        <td>Administrasi Permohonan</td>
                        <td>Sebagaimana MoU</td>
                        <td>
                            <ul>
                                <li>Surat Pengantar dari Sekolah / Perguruan Tinggi, mencakup:</li>
                                <li>Data mahasiswa/siswa (Nama, NIM/NIS, Fakultas/Program Studi/Jurusan, Semester/Kelas)</li>
                                <li>Jangka waktu Magang</li>
                                <li>Fotokopi Daftar Nilai Rapor / Transkrip terakhir</li>
                                <li>Proposal Individu, mencakup:</li>
                                <li>Data diri lengkap (CV) - Motivation Letter</li>
                                <li>Bidang pekerjaan yang diminati</li>
                                <li>Fotokopi KTP, NPWP, buku rekening tabungan</li>
                            </ul>
                        </td>
                        <td>Surat Pengantar dan Proposal disampaikan melalui email ke magang@bi.go.id</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="font-weight-bold mt-4">Pengajuan Pendaftaran</h4>
    <p>Pendaftaran dibuka dalam beberapa periode, yaitu:</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Triwulan</th>
                <th>Pengajuan Pendaftaran</th>
                <th>Pelaksanaan Magang</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Triwulan 1</td>
                <td>November</td>
                <td>Januari - Februari</td>
            </tr>
            <tr>
                <td>Triwulan 2</td>
                <td>Februari</td>
                <td>Maret - Mei</td>
            </tr>
            <tr>
                <td>Triwulan 3</td>
                <td>Mei</td>
                <td>Juli - Agustus</td>
            </tr>
            <tr>
                <td>Triwulan 4</td>
                <td>Agustus</td>
                <td>Oktober - November</td>
            </tr>
        </tbody>
    </table>
    <div class="mt-5">
        <a href="{{ route('magang') }}" class="btn btn-primary mt-2">Lanjutkan Pendaftaran Magang</a>
        <a href="{{ route('landing') }}" class="btn btn-primary mt-2">Kembali ke Beranda</a>

    </div>
</div>
@endsection
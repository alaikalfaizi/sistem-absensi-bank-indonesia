<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Absensi Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-image: url("{{ asset('images/BG.png') }}");
            background-position: center;
            background-size: 100vw auto;
            color: #fff;
            font-family: 'PT Sans', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex-grow: 1;
        }

        h1, .header-title, p, .nav-link, .btn-login, footer {
            color: #fff !important;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .logo {
            width: 40vw;
        }

        .btn-login {
            background-color: #fff;
            color: #003f7d;
            border: none;
        }

        .btn-login:hover {
            background-color: #196896;
            outline: 1px solid #fff;
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .nav-item {
            text-align: center;
        }

        .nav-link {
            padding: 10px 20px;
            font-size: 1.2rem;
        }

        .nav-tabs .nav-link {
            color: #fff;
        }

        .nav-tabs .nav-link.active {
            background-color: #003f7d;
        }

        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            .logo {
                width: 80vw;
            }
        }

        footer {
            text-align: center;
            color: #fff;
            margin-top: auto;
            padding: 1rem 0;
        }

        .header-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .icon {
            width: 30px;
            margin-right: 10px;
        }

        .vision-logo {
            width: 60px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .line-chart-container {
            background-color: #196896;
            padding: 20px;
            border-radius: 8px;
        }

        .tab-content {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
        }

        .line-chart-container canvas {
            border-radius: 8px;
        }

    </style>
</head>

<body class="container">
    <div class="text-center pt-5 px-5 mt-5 rounded" style="min-height: 100vh; background-color: #196896;">
        <div class="mt-5">
            <h2 class="header-title"><i class="fas fa-university me-2"></i>Tentang Bank Indonesia Riau</h2>

            <!-- TAB NAV -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="about-tab" data-bs-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Tentang BI Riau</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="functions-tab" data-bs-toggle="tab" href="#functions" role="tab" aria-controls="functions" aria-selected="false">Fungsi Utama</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="intern-tab" data-bs-toggle="tab" href="#intern" role="tab" aria-controls="intern" aria-selected="false">Program Magang</a>
                </li>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content mt-3" id="myTabContent">
<!-- TAB 1: Tentang BI -->
<div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab" style="text-align: justify;">
    <p><strong>Bank Indonesia Perwakilan Riau (BI Riau)</strong> merupakan perwakilan resmi Bank Indonesia yang memiliki peran strategis dalam menjaga stabilitas ekonomi di Provinsi Riau. Sebagai institusi yang bertanggung jawab atas kebijakan moneter, BI Riau memiliki tugas penting dalam mengatur dan mengawasi sistem keuangan, menjaga stabilitas makroekonomi, serta mendukung kebijakan pembangunan yang berkelanjutan. Fokus utama BI Riau mencakup pengendalian inflasi, pengaturan nilai tukar, serta dukungan terhadap pertumbuhan ekonomi daerah secara inklusif dan berkesinambungan.</p>

    <h4><i class="fas fa-briefcase icon"></i> Peran Strategis BI Riau</h4>
    <ol class="text-start" style="text-align: justify;">
        <li><strong>Pengendalian Inflasi:</strong> Menjaga tingkat inflasi yang stabil dan rendah untuk mendukung daya beli masyarakat dan iklim investasi yang kondusif.</li>
        <li><strong>Stabilisasi Nilai Tukar:</strong> Memelihara kestabilan nilai tukar Rupiah guna mengurangi ketidakpastian dalam aktivitas ekonomi dan meningkatkan kepercayaan pasar.</li>
        <li><strong>Pengaturan Sistem Pembayaran:</strong> Menyediakan sistem pembayaran yang aman, efisien, dan andal dalam mendukung transaksi ekonomi nasional maupun regional.</li>
        <li><strong>Pengawasan Sektor Perbankan:</strong> Memastikan lembaga keuangan beroperasi secara sehat, transparan, dan sesuai regulasi untuk menjaga stabilitas keuangan.</li>
        <li><strong>Kebijakan Moneter dan Makroprudensial:</strong> Mengelola keseimbangan antara pertumbuhan ekonomi dan kestabilan keuangan melalui kebijakan moneter yang adaptif dan pengawasan risiko sistemik.</li>
    </ol>

    <h4><i class="fas fa-bullseye icon"></i> Visi dan Misi BI Riau</h4>
    <p><strong>Visi:</strong> Mewujudkan perekonomian yang stabil, inklusif, dan berkelanjutan di Provinsi Riau melalui kebijakan moneter yang responsif serta pengawasan sistem keuangan yang efektif.</p>

    <p><strong>Misi:</strong></p>
    <ol class="text-start" style="text-align: justify;">
        <li>Mengendalikan inflasi agar tercipta stabilitas harga dan daya beli masyarakat.</li>
        <li>Menjaga kestabilan nilai tukar Rupiah dan ketahanan sistem keuangan daerah.</li>
        <li>Mengembangkan sistem pembayaran yang efisien, aman, dan menjangkau seluruh lapisan masyarakat.</li>
        <li>Menerapkan kebijakan moneter yang mendukung pertumbuhan ekonomi daerah secara berkesinambungan.</li>
        <li>Menjamin integritas sektor keuangan melalui pengawasan yang transparan dan terpercaya.</li>
    </ol>

    <h4><i class="fas fa-history icon"></i> Sejarah BI Riau</h4>
    <p>Bank Indonesia Perwakilan Riau dibentuk untuk memperluas jangkauan kebijakan moneter nasional ke tingkat regional, seiring dengan pesatnya pertumbuhan ekonomi Riau di sektor minyak, gas, dan perkebunan. Sejak awal berdirinya, BI Riau telah menjalankan fungsi strategis dalam menjaga stabilitas ekonomi daerah, mengawasi perbankan, serta mendorong efisiensi sistem pembayaran. Dalam perjalanannya, BI Riau terus berinovasi dan beradaptasi dengan perkembangan ekonomi dan teknologi guna mendukung pembangunan ekonomi daerah yang inklusif dan berkelanjutan.</p>
</div>

<!-- TAB 2: Fungsi Utama -->
<div class="tab-pane fade" id="functions" role="tabpanel" aria-labelledby="functions-tab" style="text-align: justify;">
    <h4><i class="fas fa-chart-line icon"></i> Stabilitas Moneter</h4>
    <p>Bank Indonesia bertugas menjaga kestabilan nilai Rupiah melalui pengendalian inflasi dan kebijakan moneter. Hal ini dilakukan dengan menetapkan suku bunga acuan, mengatur jumlah uang beredar, dan melakukan operasi pasar terbuka. Tujuannya adalah menciptakan kondisi ekonomi yang stabil agar mendukung pertumbuhan ekonomi nasional dan daya beli masyarakat.</p>

    <h4><i class="fas fa-credit-card icon"></i> Sistem Pembayaran</h4>
    <p>Bank Indonesia mengelola dan mengawasi sistem pembayaran nasional untuk memastikan transaksi keuangan berjalan lancar, aman, dan efisien. Ini mencakup pengembangan infrastruktur digital seperti BI-FAST, QRIS, serta penyusunan regulasi untuk mencegah penyalahgunaan sistem pembayaran oleh pihak yang tidak bertanggung jawab.</p>

    <h4><i class="fas fa-building-columns icon"></i> Stabilitas Keuangan</h4>
    <p>BI turut berperan dalam menjaga stabilitas sistem keuangan nasional dengan cara mengawasi sektor keuangan secara menyeluruh, mendeteksi potensi risiko sistemik, serta berkoordinasi dengan otoritas terkait seperti OJK dan LPS. Fungsi ini penting untuk menjaga kepercayaan publik dan mencegah krisis keuangan.</p>

    <h4><i class="fas fa-shield-alt icon"></i> Kebijakan Makroprudensial</h4>
    <p>Kebijakan makroprudensial dirancang untuk memperkuat ketahanan sistem keuangan dan memitigasi risiko yang bisa mengganggu stabilitas ekonomi. BI mengatur rasio kredit terhadap pendapatan (LTV/FTV), rasio likuiditas, serta kebijakan penyangga permodalan bank agar sistem keuangan tetap sehat dan inklusif.</p>

    <h4><i class="fas fa-users icon"></i> Edukasi dan Perlindungan Konsumen</h4>
    <p>Bank Indonesia juga berperan dalam memberikan edukasi kepada masyarakat mengenai keuangan, sistem pembayaran, serta peran dan fungsi BI. Melalui kegiatan sosialisasi dan literasi keuangan, BI mendorong masyarakat agar lebih cakap dalam mengelola keuangan dan memahami hak-haknya sebagai konsumen.</p>

    <h4><i class="fas fa-globe-asia icon"></i> Pendalaman Pasar Keuangan</h4>
    <p>BI mendorong pengembangan pasar keuangan domestik agar lebih dalam, likuid, dan efisien. Ini termasuk pengembangan instrumen keuangan syariah, obligasi pemerintah, dan pasar uang antarbank, guna mendukung pembiayaan pembangunan nasional secara berkelanjutan.</p>
</div>


                <!-- TAB 3: Program Magang -->
                <div class="tab-pane fade" id="intern" role="tabpanel" aria-labelledby="intern-tab">
                    <p>Program ini memberikan pengalaman langsung bagi mahasiswa untuk memahami kerja institusi keuangan negara terkhususnya di provinsi Riau.</p>
                    <img src="{{ asset('images/BI Absen Online.png') }}" alt="Logo Bank Indonesia Riau" class="img-fluid logo rounded mb-4">
                    <h1 class="mb-2">Selamat Datang,<br>di Sistem Absensi Online</h1>
                    <p class="mb-4">Situs web ini digunakan untuk absensi harian Supervisor dan Magang di Kantor Perwakilan Bank Indonesia Provinsi Riau</p>
                    <a href="{{ route('login') }}" class="btn btn-login py-2 px-5 mt-2" style="background-color:rgb(0, 54, 108); color: white;">Masuk</a>
                    <a href="{{ route('magang.info') }}" class="btn btn-login py-2 px-5 mt-2" style="background-color:rgb(0, 54, 108); color: white;">Daftar Magang</a>
                </div>
            </div>
        </div>

        <!-- Grafik Inflasi -->
        <div class="line-chart-container animate-fade-in my-5">
            <canvas id="lineChart"></canvas>
        </div>

        <footer class="mx-2">
            &copy; {{ date('Y') }} Created by Rahmat Zuhri Hafidz & Alaik Haikal A. - Bank Indonesia Riau
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Inflasi Provinsi Riau 2025 (%)',
                    data: [0.02, 0.50, 0.68],
                    borderColor: 'rgb(255, 255, 255)',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#fff'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>

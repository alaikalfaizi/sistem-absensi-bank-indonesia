<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
    />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <style>
        :root {
            --bi-blue: #002366;
            --bi-white: #ffffff;
        }

        body {
            background-image: url("{{ asset('images/BG2.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            color: var(--bi-blue);
        }

        h3 {
            color: #196896;
            margin-bottom: 0;
        }

        th {
            background-color: #196896 !important;
            color: #fff !important;
            vertical-align: top;
        }

        td,
        th {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        label {
            color: #196896;
        }

        .navbar-bi {
            background-color: #196896;
        }

        .navbar-bi .nav-link,
        .navbar-bi .navbar-brand,
        .navbar-bi .navbar-text {
            color: #fff;
        }

        .navbar-bi .nav-link.active,
        .navbar-bi .nav-link:hover {
            font-weight: bold;
            text-decoration: underline;
        }

        .navbar {
            box-shadow: 0px 0px 26px -3px rgba(0, 0, 0, 0.59);
            -webkit-box-shadow: 0px 0px 26px -3px rgba(0, 0, 0, 0.59);
            -moz-box-shadow: 0px 0px 26px -3px rgba(0, 0, 0, 0.59);
        }

        .btn-outline-light {
            border-color: var(--bi-white);
            color: var(--bi-white);
        }

        .btn-outline-light:hover {
            background-color: var(--bi-white);
            color: var(--bi-blue);
        }

        .alert-success {
            background-color: #cce5ff;
            color: #004085;
            border-color: #b8daff;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .logo {
            width: 2rem;
        }

        .btn-primary {
            background: transparent linear-gradient(124deg, #267dc2 0, #065695 100%) 0 0 no-repeat
                padding-box;
            border: none;
        }

        .btn-primary:hover {
            font-weight: 600;
            opacity: 0.95;
        }

        .btn-login {
            background-color: #196896;
            color: #fff;
            border-color: #fff;
        }

        .btn-login:hover {
            background-color: #fff;
            color: #196896;
            outline: 1px solid #196896;
        }

        .card {
            background: transparent linear-gradient(124deg, #267dc2 0, #065695 100%) 0 0 no-repeat padding-box;
            color: #fff;
        }

        .card:hover {
            opacity: 0.95;
        }

        .card-body > p {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .font-weight-bold {
            font-weight: 600;
        }

        .masuk,
        .keluar {
            background-color: #fff;
            color: #196896;
        }

        .item-proker {
            background-color: #f5f5f5;
            color: #196896;
        }

        .nav-link.show {
            color: #065695 !important;
        }

        .dropdown-item:hover {
            text-decoration: underline;
        }

        .dropdown-item:active {
            background-color: #196896;
        }

        .bg-blue {
            background-color: #f5f5f5;
            color: #196896 !important;
        }

        .info-magang {
            color: #000;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-bi mb-4">
        <div class="container">
            <a class="navbar-brand">
                <img src="{{ asset('images/bi-logo.png') }}" alt="Logo BI" class="logo me-3" />
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarAbsensi"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse justify-content-between"
                id="navbarAbsensi"
            >
                <ul class="navbar-nav">
                    @php $role = auth()->check() ? auth()->user()->role : null; @endphp

                    @if($role === 'karyawan')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.absensi') }}"
                            >Dashboard</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.riwayat') }}"
                            >Riwayat Aktivitas</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('karyawan.rekap') }}"
                            >Rekap Harian</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link text-success"
                            href="{{ route('karyawan.isilogbook') }}"
                            >Isi Logbook</a
                        >
                    </li>
                    @elseif($role === 'staff')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('staff.dashboard') }}"
                            >Beranda</a
                        >
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="dropdownMenuRiwayat"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            Riwayat
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuRiwayat">
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('staff.riwayat.pribadi') }}"
                                    >Harian Pribadi</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('staff.riwayat.karyawan.harian') }}"
                                    >Harian Magang</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('staff.riwayat.global') }}"
                                    >Global</a
                                >
                            </li>
                        </ul>
                    </li>
                    @elseif($role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}"
                            >Beranda</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.manageUsers') }}"
                            >Manajemen Akun</a
                        >
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="dropdownMenuAdmin"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            Riwayat Aktivitas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuAdmin">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.rekap') }}"
                                    >Rekapitulasi</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.absensi') }}"
                                    >Absensi</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.logbook') }}"
                                    >Logbook</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.programKerja') }}"
                                    >Program Kerja</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('admin.peserta_magang') }}"
                            >Pendataan Pendaftaran Magang</a
                        >
                    </li>
                    @elseif($role === 'magang')
                    <li class="nav-item">
                        <a
                            class="nav-link mt-xl-0 mt-sm-2 mt-2"
                            href="{{ route('magang.dashboard') }}"
                            >Beranda</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('magang.riwayat_harian') }}"
                            >Absensi</a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('magang.logbook') }}"
                            >Logbook</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ route('magang.programkerja.index') }}"
                            >Program Kerja</a
                        >
                    </li>
                    @endif
                </ul>

                <!-- User Info -->
                <ul class="navbar-nav">
                    @auth
                    <li class="d-flex nav-item">
                        <span class="navbar-text me-4">
                            <i class="bi bi-person-circle me-2"></i>{{
                            auth()->user()->name }}
                        </span>
                    </li>
                    <li class="d-flex align-items-center nav-item">
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="d-inline"
                        >
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-login btn-sm my-xl-0 my-sm-2 my-2"
                            >
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>


        @if(isset($statusAbsen))
        <div
            class="alert alert-info alert-dismissible fade show"
            role="alert"
        >
            {{ $statusAbsen }}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
        @endif

        @yield('content')
    </div>

    <!-- JS Scripts -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            @if(session("success"))
            Swal.fire({
                icon: "success",
                title: "Sukses!",
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            @endif

            @if(session("error"))
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "{{ session('error') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
            @endif
        });
    </script>
</body>

</html>

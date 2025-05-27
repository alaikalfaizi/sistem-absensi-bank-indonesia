<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\FilemagangController;



// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// Halaman INFORMASI MAGANG
Route::get('/daftar-magang', function () {
    return view('magang.informasi-magang'); // sesuai path kamu
})->name('magang.info');

Route::get('/pendaftaran-magang', [FilemagangController::class, 'showForm'])->name('magang');
Route::post('/pendaftaran-magang', [FilemagangController::class, 'submitForm'])->name('magang.submit');
Route::get('/pendaftaran-magang/konfirmasi', [MagangController::class, 'konfirmasi']);




// Protected routes
Route::middleware(['auth'])->group(function () {

    // Dashboard redirection based on role
    Route::get('/dashboard', function () {
        $user = Auth::user();
    
        switch ($user->role) {
            case 'admin':
                return view('dashboard.admin_dashboard');
            case 'staff':
                return view('dashboard.staff_dashboard');
            case 'magang':
                return view('dashboard.magang_dashboard'); // Correct here
            case 'karyawan':
                return view('dashboard.karyawan_dashboard'); // Add route for karyawan if needed
            default:
                return abort(403);
        }
    })->name('dashboard');

// routes/web.php
Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Menambahkan route untuk peserta magang
    Route::get('/peserta-magang', [AdminController::class, 'pesertaMagang'])->name('peserta_magang');
    
    Route::put('/update-status/{id}', [AdminController::class, 'updateStatus'])->name('update_status');

    // Menambahkan route untuk detail peserta magang
    Route::get('/peserta-magang/{id}', [AdminController::class, 'showPesertaMagang'])->name('peserta_magang.show');

    // Route lainnya
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('manageUsers');
    Route::get('/rekap', [AdminController::class, 'rekap'])->name('rekap');
    Route::get('/absensi', [AdminController::class, 'absensi'])->name('absensi');
    Route::get('/absensi/export', [AdminController::class, 'exportAbsensi'])->name('exportAbsensi'); // Pastikan route ini ada
    Route::get('/logbook', [AdminController::class, 'logbook'])->name('logbook');
    Route::get('/logbook/export', [AdminController::class, 'exportLogbook'])->name('exportLogbook'); // Pastikan route ini ada
    Route::get('/register', [AdminController::class, 'showCreateUserForm'])->name('register');
    Route::post('/register', [AdminController::class, 'createUser'])->name('register.submit');
    Route::get('/program-kerja/export', [AdminController::class, 'exportProgramKerja'])->name('exportProgramKerja'); // Pastikan route ini ada
    Route::get('/program-kerja', [AdminController::class, 'showProgramKerja'])->name('programKerja');
    Route::get('/rekap/export', [AdminController::class, 'exportRekap'])->name('exportRekap'); // Pastikan ini ada


});




    // Route for staff
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
        Route::post('/absen-masuk', [StaffController::class, 'absenMasuk'])->name('absensi.masuk');
        Route::post('/absen-keluar', [StaffController::class, 'absenKeluar'])->name('absensi.keluar');
        Route::get('/input-absensi', [StaffController::class, 'inputAbsensi'])->name('absensi.input');
        Route::post('/store-absensi', [StaffController::class, 'storeAbsensi'])->name('absensi.store');
        Route::get('/logbook', [StaffController::class, 'logbook'])->name('logbook');
        Route::post('/logbook/store', [StaffController::class, 'storeLogbook'])->name('logbook.store');
        Route::get('/input-logbook', [StaffController::class, 'inputLogbook'])->name('logbook.input');
        Route::post('/store-logbook', [StaffController::class, 'storeLogbookManual'])->name('logbook.manual.store');
        Route::get('/riwayat-pribadi', [StaffController::class, 'riwayatHarianPribadi'])->name('riwayat.pribadi');
        Route::get('/riwayat-karyawan-harian', [StaffController::class, 'riwayatHarianKaryawan'])->name('riwayat.karyawan.harian');
        Route::get('/riwayat-global', [StaffController::class, 'riwayatGlobal'])->name('riwayat.global');
        Route::get('/rekap-bulanan', [StaffController::class, 'rekapBulanan'])->name('rekap.bulanan');
        Route::get('/data-karyawan', [StaffController::class, 'dataKaryawan'])->name('data.karyawan');
        Route::get('/data-absensi', [StaffController::class, 'dataAbsensi'])->name('data.absensi');
        Route::get('/data-logbook', [StaffController::class, 'dataLogbook'])->name('data.logbook');
    });

    Route::middleware('role:magang')->prefix('magang')->name('magang.')->group(function () {
        Route::get('/dashboard', [MagangController::class, 'index'])->name('dashboard');  // pastikan ini sudah benar
        Route::get('/riwayat-harian', [MagangController::class, 'riwayatHarian'])->name('riwayat_harian');  // ubah dari 'magang.riwayat_pribadi' jadi 'riwayat_harian'
        Route::post('/absen-masuk', [MagangController::class, 'absenMasuk'])->name('absensi.masuk');
        Route::post('/absen-keluar', [MagangController::class, 'absenKeluar'])->name('absensi.keluar');
        Route::get('/logbook', [MagangController::class, 'logbook'])->name('logbook');
        Route::post('/logbook', [MagangController::class, 'logbook'])->name('logbook'); // Menggunakan rute yang sama
        Route::get('/programkerja', [MagangController::class, 'showProgramKerja'])->name('programkerja.index');
        Route::post('/programkerja', [MagangController::class, 'storeProgramKerja'])->name('programkerja.store');
    });
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
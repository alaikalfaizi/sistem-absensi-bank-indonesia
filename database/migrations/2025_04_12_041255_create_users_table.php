<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tabel ini menggunakan auto-increment ID
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email yang unik
            $table->timestamp('email_verified_at')->nullable(); // Tanggal verifikasi email
            $table->string('password'); // Password untuk login
            $table->enum('role', ['admin', 'staff', 'magang', 'karyawan']); // Role yang bisa dipilih
            $table->rememberToken(); // Token untuk "remember me" pada login
            $table->timestamps(); // Tanggal dan waktu dibuat serta diperbarui
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}



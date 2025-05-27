<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users'); // foreign key ke tabel users
            $table->date('tanggal');
            $table->timestamp('jam_masuk')->nullable()->change();  // Ubah jadi nullable
            $table->timestamp('jam_keluar')->nullable()->change(); // Ubah jadi nullable
            $table->string('lokasi_masuk')->nullable();
            $table->string('lokasi_keluar')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}

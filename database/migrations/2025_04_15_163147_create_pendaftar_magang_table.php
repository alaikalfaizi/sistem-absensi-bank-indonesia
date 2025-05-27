<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarMagangTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftar_magang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('jenis_kelamin');
            $table->string('domisili');
            $table->string('no_hp');
            $table->string('asal_universitas');
            $table->string('asal_jurusan');
            $table->string('unit_kerja');
            $table->string('keahlian');
            $table->string('link_portofolio');
            $table->string('berkas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftar_magang');
    }
}

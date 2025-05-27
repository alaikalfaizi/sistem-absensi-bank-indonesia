<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPendaftarMagangTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('domisili')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('keahlian')->nullable();
            $table->string('link_portofolio')->nullable();
            $table->string('berkas')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'jenis_kelamin',
                'domisili',
                'no_hp',
                'keahlian',
                'link_portofolio',
                'berkas',
            ]);
        });
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalPendaftaranToPendaftarMagangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->date('tanggal_pendaftaran')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->dropColumn('tanggal_pendaftaran');
        });
    }
}

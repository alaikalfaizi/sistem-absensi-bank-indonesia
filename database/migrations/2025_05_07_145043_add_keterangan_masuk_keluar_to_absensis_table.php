<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganMasukKeluarToAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            // Menambahkan kolom untuk keterangan masuk dan keluar
            $table->string('keterangan_masuk')->nullable();
            $table->string('keterangan_keluar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            // Menghapus kolom keterangan masuk dan keluar jika rollback
            $table->dropColumn('keterangan_masuk');
            $table->dropColumn('keterangan_keluar');
        });
    }
}

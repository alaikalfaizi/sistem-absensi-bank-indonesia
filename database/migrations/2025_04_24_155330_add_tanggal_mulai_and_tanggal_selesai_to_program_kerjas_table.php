<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggalMulaiAndTanggalSelesaiToProgramKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_kerjas', function (Blueprint $table) {
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('program_kerjas', function (Blueprint $table) {
            $table->dropColumn(['tanggal_mulai', 'tanggal_selesai']);
        });
    }
    
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPendaftarMagangTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->string('status')->nullable()->default('Menunggu');
        });
    }
    
    public function down()
    {
        Schema::table('pendaftar_magang', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
}

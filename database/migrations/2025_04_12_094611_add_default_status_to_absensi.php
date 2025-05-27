<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultStatusToAbsensi extends Migration
{
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('status')->default('Hadir')->change();
        });
    }
    
    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('status')->default('')->change(); // Atau kembali ke default sebelumnya
        });
    }
    
}

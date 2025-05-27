<?php

// Update Migration untuk menambahkan default value pada kolom status
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAbsensiTable extends Migration
{
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('status')->default('Hadir')->change();  // Set default value 'Hadir'
        });
    }

    public function down()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->string('status')->nullable()->change();  // Revert to nullable if needed
        });
    }
}

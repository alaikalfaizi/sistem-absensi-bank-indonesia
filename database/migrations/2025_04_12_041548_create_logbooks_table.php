<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbooksTable extends Migration
{
    public function up()
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Menghubungkan dengan user
            $table->date('tanggal');               // Tanggal logbook
            $table->string('aktivitas');           // Aktivitas yang dilakukan
            $table->text('deskripsi')->nullable(); // Deskripsi aktivitas
            $table->timestamps();                  // created_at dan updated_at otomatis ditambahkan
            
            // Menambahkan foreign key untuk hubungan dengan users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('logbooks');
    }
}

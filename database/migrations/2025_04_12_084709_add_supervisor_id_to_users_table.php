<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupervisorIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom supervisor_id
            $table->unsignedBigInteger('supervisor_id')->nullable()->after('role');

            // Menambahkan relasi foreign key (opsional)
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus foreign key dan kolom supervisor_id jika rollback
            $table->dropForeign(['supervisor_id']);
            $table->dropColumn('supervisor_id');
        });
    }
}

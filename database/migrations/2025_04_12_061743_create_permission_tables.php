<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTables extends Migration
{
    public function up()
    {
        // Membuat tabel 'roles'
        Schema::create('roles', function (Blueprint $table) {
            $table->id();  // ID auto-increment
            $table->string('name');  // Nama role (misalnya: admin, staff, dll)
            $table->string('guard_name');  // Guard untuk role (misalnya: web, api)
            $table->timestamps();  // Timestamp untuk pencatatan waktu pembuatan dan update
        });

        // Membuat tabel 'permissions'
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();  // ID auto-increment
            $table->string('name');  // Nama permission (misalnya: view-dashboard, create-post, dll)
            $table->string('guard_name');  // Guard untuk permission (misalnya: web, api)
            $table->timestamps();  // Timestamp
        });

        // Membuat tabel 'model_has_roles' untuk menyimpan hubungan antara model dan role
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->id();  // ID auto-increment
            $table->morphs('model');  // Kolom untuk relasi polymorphic (model_type, model_id)
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');  // Foreign key ke tabel roles
            $table->timestamps();  // Timestamp
        });

        // Membuat tabel 'model_has_permissions' untuk menyimpan hubungan antara model dan permission
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->id();  // ID auto-increment
            $table->morphs('model');  // Kolom untuk relasi polymorphic (model_type, model_id)
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');  // Foreign key ke tabel permissions
            $table->timestamps();  // Timestamp
        });
    }

    public function down()
    {
        // Menurunkan (drop) tabel yang telah dibuat
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}

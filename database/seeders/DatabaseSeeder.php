<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    \Spatie\Permission\Models\Role::create(['name' => 'admin']);
    \Spatie\Permission\Models\Role::create(['name' => 'staff']);
    \Spatie\Permission\Models\Role::create(['name' => 'magang']);

    }
}

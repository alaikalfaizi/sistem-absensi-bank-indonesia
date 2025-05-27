<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KaryawanSeeder::class,
        ]);

        User::create([
            'name' => 'Karyawan Satu',
            'email' => 'karyawan@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
    }
}

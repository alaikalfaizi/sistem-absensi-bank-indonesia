<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi'; // Nama tabel absensi yang sesuai dengan database

    protected $fillable = [
        'user_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'lokasi_masuk', 'lokasi_keluar', 'keterangan'
    ];

    // Konversi otomatis atribut tanggal, jam_masuk, dan jam_keluar ke tipe Carbon
    protected $casts = [
        'tanggal' => 'date',       // Mengubah tanggal menjadi objek Carbon
        'jam_masuk' => 'datetime', // Mengubah jam_masuk menjadi objek Carbon
        'jam_keluar' => 'datetime', // Mengubah jam_keluar menjadi objek Carbon
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Menghubungkan user_id ke id pengguna
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    // Cukup pakai user_id
    protected $fillable = ['user_id', 'tanggal', 'aktivitas', 'deskripsi'];

    /**
     * Relasi ke Karyawan (relasi ke tabel users)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

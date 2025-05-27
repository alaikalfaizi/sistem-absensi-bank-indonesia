<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = ['judul', 'deskripsi', 'user_id'];

    // Relasi dengan model User (relasi ke pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

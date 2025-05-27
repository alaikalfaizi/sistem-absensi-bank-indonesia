<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarMagang extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_magang';

    protected $fillable = [
        'nama',
        'email',
        'jenis_kelamin',
        'domisili',
        'no_hp',
        'asal_universitas',
        'asal_jurusan',
        'unit_kerja',
        'keahlian',
        'link_portofolio',
        'berkas',
    ];
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'supervisor_id', // Untuk supervisi staff
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id');
    }

    // Relasi ke logbook
    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'user_id');
    }

    // Relasi: user yang disupervisi oleh staff ini (staff -> banyak magang)
    public function supervisedUsers()
    {
        return $this->hasMany(User::class, 'supervisor_id');
    }

    // Relasi: supervisor dari user ini (magang -> 1 staff)
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // Accessor untuk memformat last_login_at
    public function getLastLoginAtFormattedAttribute()
    {
        return $this->last_login_at ? Carbon::parse($this->last_login_at)->format('d M Y, H:i') : 'Belum pernah login';
    }
}

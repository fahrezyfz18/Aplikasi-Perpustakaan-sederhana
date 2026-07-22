<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
<-- Model User -->

Model User digunakan Laravel
untuk proses autentikasi login.

Model ini tetap dipertahankan
agar Login, Seeder, dan CRUD
tidak mengalami perubahan.
*/

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    <-- Field yang boleh diisi -->
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomorAnggota',
        'maxPinjam',
    ];

    /*
    <-- Field yang disembunyikan -->
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    <-- Konversi tipe data -->
    */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /*
    <-- Relasi User ke Peminjaman -->

    Satu user dapat memiliki
    banyak data peminjaman.
    */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }
}
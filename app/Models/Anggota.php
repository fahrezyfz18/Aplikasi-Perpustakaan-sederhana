<?php

namespace App\Models;

/*
<-- Model Anggota -->
OOP Concept: INHERITANCE (Mewarisi Pengguna)
*/
class Anggota extends Pengguna
{
    // Properti sesuai spesifikasi soal
    protected $fillable = [
        'name', 'email', 'password', 'role', 'nomorAnggota', 'maxPinjam'
    ];

    /**
     * OOP Concept: METHOD OVERRIDING (Polymorphism)
     * Mengimplementasikan method abstrak dari class Pengguna.
     */
    public function aksesMenu(): string
    {
        return "Akses Anggota: Lihat Buku dan Meminjam Buku.";
    }

    public function login(): string
    {
        return "Anggota {$this->name} berhasil login.";
    }

    protected static function booted()
    {
        static::addGlobalScope('anggota', function ($builder) {
            $builder->where('role', 'anggota');
        });
    }

    public function lihatDaftarBuku()
    {
        return Buku::where('status', 'Tersedia')->get();
    }

    public function pinjamBuku(Buku $buku): void
    {
        if ($buku->isTersedia()) {
            $buku->updateStatus("Dipinjam");
        }
    }
}
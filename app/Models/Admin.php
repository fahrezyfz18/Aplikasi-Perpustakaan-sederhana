<?php

namespace App\Models;

/*
<-- Model Admin -->
OOP Concept: INHERITANCE (Mewarisi Pengguna)
*/
class Admin extends Pengguna
{
    /**
     * OOP Concept: METHOD OVERRIDING (Polymorphism)
     * Mengimplementasikan method abstrak dari class Pengguna.
     */
    public function aksesMenu(): string
    {
        return "Akses Full Admin: Kelola Buku, Kategori, dan Transaksi Pengembalian.";
    }

    public function login(): string
    {
        return "Admin {$this->name} berhasil login.";
    }

    protected static function booted()
    {
        static::addGlobalScope('admin', function ($builder) {
            $builder->where('role', 'admin');
        });
    }

    public function kelolaBuku()
    {
        return Buku::all();
    }
}
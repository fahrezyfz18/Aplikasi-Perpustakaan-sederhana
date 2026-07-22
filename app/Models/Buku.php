<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $primaryKey = 'idBuku';

    protected $fillable = [
        'judul',
        'penulis',
        'kategori',      // Kolom teks lama (dipertahankan)
        'kategori_id',   // FK ke tabel kategoris (tambahan sinkronisasi)
        'status',
    ];

    /**
     * OOP Concept: Encapsulation (Pengapsulan)
     * Method ini menyembunyikan logika internal pengecekan status ketersediaan buku.
     */
    public function isTersedia(): bool
    {
        return $this->status === 'Tersedia';
    }

    /**
     * OOP Concept: Encapsulation & Behavioral Method
     * Mengubah status buku secara aman melalui method objek.
     */
    public function updateStatus(string $statusBaru): void
    {
        $this->update([
            'status' => $statusBaru
        ]);
    }

    /**
     * OOP Concept: Association / Relationship
     * Relasi Banyak ke Satu (Many-to-One): Setiap buku terikat ke satu objek Kategori.
     */
    public function kategoriRelation()
    {
        return $this->belongsTo(
            Kategori::class,
            'kategori_id',
            'idKategori'
        );
    }

    // Method relasi lama dipertahankan
    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'kategori_id',
            'idKategori'
        );
    }

    /**
     * OOP Concept: Association / Relationship
     * Relasi Satu ke Banyak (One-to-Many): Satu buku bisa memiliki banyak riwayat Peminjaman.
     */
    public function peminjamans()
    {
        return $this->hasMany(
            Peminjaman::class,
            'buku_id',
            'idBuku'
        );
    }
}
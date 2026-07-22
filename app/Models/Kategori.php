<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'idKategori';

    protected $fillable = [
        'namaKategori'
    ];

    // Association:
    // Satu kategori dapat dimiliki banyak buku.
    public function bukus()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'idKategori');
    }
}

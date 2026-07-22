<?php

namespace App\Models;

use App\Contracts\DendaCalculator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/*
<-- Model Peminjaman -->
OOP Concept: INTERFACE IMPLEMENTATION
Class Peminjaman wajib memenuhi kontrak interface DendaCalculator.
*/
class Peminjaman extends Model implements DendaCalculator
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'idPinjam';
    protected $fillable = ['buku_id', 'user_id', 'tanggalPinjam', 'tanggalKembali', 'status', 'denda'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'idBuku');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hitungLamaPinjam(): int
    {
        $tglPinjam = Carbon::parse($this->tanggalPinjam);
        $tglKembali = $this->tanggalKembali ? Carbon::parse($this->tanggalKembali) : Carbon::now();
        return (int) $tglPinjam->diffInDays($tglKembali);
    }

    public function setTanggalKembali(string $tanggal): void
    {
        $this->tanggalKembali = $tanggal;
    }

    /**
     * OOP Concept: REALISASI INTERFACE
     * Mengimplementasikan logika hitungDenda dari interface DendaCalculator.
     */
    public function hitungDenda(int $jumlahHariTerlambat): float
    {
        $tarifPerHari = 2000;
        return $jumlahHariTerlambat > 0 ? (float) ($jumlahHariTerlambat * $tarifPerHari) : 0.0;
    }
}

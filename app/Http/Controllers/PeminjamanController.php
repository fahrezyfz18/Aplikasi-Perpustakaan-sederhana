<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{

    // ==========================
    // ANGGOTA PINJAM BUKU
    // ==========================

    public function pinjam($idBuku)
    {

        $buku = Buku::findOrFail($idBuku);

        // Cek buku tersedia
        if (!$buku->isTersedia()) {

            return redirect()->back()
                ->with('error', 'Buku sedang tidak tersedia!');
        }

        // Cek user sudah pernah pinjam buku ini
        $cek = Peminjaman::where('buku_id', $idBuku)
            ->where('user_id', auth()->id())
            ->where('status', 'Dipinjam')
            ->first();
            
        if ($cek) {

            return redirect()->back()
                ->with('error', 'Anda sudah meminjam buku ini!');
        }

        // Simpan peminjaman
        Peminjaman::create([
            'buku_id' => $buku->idBuku,
            'user_id' => auth()->id(),
            'tanggalPinjam' => Carbon::now()->toDateString(),
            'tanggalKembali' => null,
            'status' => 'Dipinjam',
            'denda' => 0
        ]);

        // Update status buku
        $buku->updateStatus('Dipinjam');
        return redirect()->back()
            ->with('success', 'Buku berhasil dipinjam!');
    }

    // ==========================
    // ADMIN KEMBALIKAN BUKU
    // ==========================

    public function kembalikan($idPinjam)
    {
        $peminjaman = Peminjaman::findOrFail($idPinjam);
        $tanggalKembali = Carbon::now();
        $lamaPinjam = $peminjaman->hitungLamaPinjam();
        $terlambat = max(
            0,
            $lamaPinjam - 7
        );

        $denda = $peminjaman->hitungDenda(
            $terlambat
        );

        $peminjaman->update([

            'tanggalKembali' => $tanggalKembali
                ->toDateString(),

            'status' => 'Kembali',

            'denda' => $denda

        ]);

        // buku kembali tersedia

        $peminjaman->buku->update([

            'status' => 'Tersedia'

        ]);

        return redirect()->back()
            ->with(
                'success',
                'Buku berhasil dikembalikan'
            );
    }
}

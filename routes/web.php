<?php

use Illuminate\Support\Facades\Route;
// Import Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
// Import Model
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

// ===========================
// Halaman Awal
// ===========================
Route::get('/', function () {
    return redirect()->route('login');
});

// ===========================
// Login
// ===========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===========================
// Route Setelah Login
// ===========================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {

        $bukus = Buku::with('kategoriRelation')->get();
        $kategoris = Kategori::all();
        $peminjamans = Peminjaman::with([
            'buku',
            'user'
        ])->get();

        return view('dashboard', compact(
            'bukus',
            'peminjamans',
            'kategoris'
        ));
    })->name('dashboard');

    // ===========================
    // CRUD BUKU
    // ===========================

    Route::get(
        '/buku',
        [BukuController::class, 'index']
    )->name('buku.index');

    Route::get(
        '/buku/create',
        [BukuController::class, 'create']
    )->name('buku.create');

    Route::post(
        '/buku',
        [BukuController::class, 'store']
    )->name('buku.store');

    Route::get(
        '/buku/{id}/edit',
        [BukuController::class, 'edit']
    )->name('buku.edit');

    Route::put(
        '/buku/{id}',
        [BukuController::class, 'update']
    )->name('buku.update');

    Route::delete(
        '/buku/{id}',
        [BukuController::class, 'destroy']
    )->name('buku.destroy');

    // ===========================
    // CRUD KATEGORI
    // ===========================

    Route::get(
        '/kategori',
        [KategoriController::class, 'index']
    )->name('kategori.index');

    Route::post(
        '/kategori',
        [KategoriController::class, 'store']
    )->name('kategori.store');

    Route::put(
        '/kategori/{id}',
        [KategoriController::class, 'update']
    )->name('kategori.update');

    Route::delete(
        '/kategori/{id}',
        [KategoriController::class, 'destroy']
    )->name('kategori.destroy');

    // ===========================
    // PEMINJAMAN
    // ===========================

    Route::post(
        '/pinjam/{idBuku}',
        [PeminjamanController::class, 'pinjam']
    )->name('buku.pinjam');

    Route::post(
        '/kembalikan/{idPinjam}',
        [PeminjamanController::class, 'kembalikan']
    )->name('buku.kembalikan');

    // ===========================
    // Pengajuan Pengembalian
    // ===========================

    Route::post(
        '/buku/ajukan-kembali/{id}',
        [BukuController::class, 'ajukanPengembalian']
    )->name('buku.ajukanKembali');

    // ===========================
    // Konfirmasi Pengembalian
    // ===========================

    Route::post(
        '/buku/konfirmasi-kembali/{id}',
        [BukuController::class, 'konfirmasiPengembalian']
    )->name('buku.konfirmasiKembali');
});

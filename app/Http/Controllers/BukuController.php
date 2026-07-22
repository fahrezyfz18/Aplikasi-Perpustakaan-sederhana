<?php

namespace App\Http\Controllers;

// [OOP CONCEPT: Encapsulation & Dependency Import]
// Mengimpor kelas Model dan HTTP Request agar dapat digunakan sebagai objek di controller ini.
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

/**
 * [OOP CONCEPT: Class & Inheritance]
 * BukuController adalah Class turunan (subclass) dari Controller utama.
 * Class ini bertanggung jawab mengelola perilaku (behavior/method) terkait entitas Buku dan Pengembalian.
 */
class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku.
     * [OOP CONCEPT: Message Passing & Eager Loading via Class Method]
     */
    public function index()
    {
        // Pemanggilan method statis ::with() dan ::all() merupakan representasi Abstraction
        // di mana logika interaksi query SQL disembunyikan oleh Eloquent ORM.
        $bukus = Buku::with('kategoriRelation')->get();
        $kategoris = Kategori::all();

        return view('buku.index', compact('bukus', 'kategoris'));
    }

    /**
     * Menampilkan form tambah buku.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    /**
     * Menyimpan data buku baru.
     * [OOP CONCEPT: Polymorphic input data handling & Object Instantiation via ORM]
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'idKategori' => 'required|exists:kategoris,idKategori',
        ]);

        // 2. [OOP CONCEPT: Object Lookup]
        // Mengambil instance dari model Kategori berdasarkan primary key ID.
        $katObj = Kategori::find($request->idKategori);

        // Akses atribut object ($katObj->namaKategori)
        $namaKategori = $katObj ? $katObj->namaKategori : 'Umum';

        // 3. [OOP CONCEPT: Factory Method / Mass Assignment]
        // Membuat instance objek Buku baru dan menyimpannya langsung ke database.
        Buku::create([
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'kategori'    => $namaKategori,
            'kategori_id' => $request->idKategori,
            'status'      => 'Tersedia',
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit($id)
    {
        // [OOP CONCEPT: Exception Handling via FindOrFail]
        // Jika object dengan ID tersebut tidak ditemukan, ORM melempar ModelNotFoundException.
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    /**
     * Memperbarui data buku.
     * [OOP CONCEPT: State Mutation / Updating Object State]
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'idKategori' => 'required|exists:kategoris,idKategori',
        ]);

        $buku = Buku::findOrFail($id);

        $katObj = Kategori::find($request->idKategori);
        $namaKategori = $katObj ? $katObj->namaKategori : $buku->kategori;

        // Mengubah keadaan (state) objek $buku di database melalui method update()
        $buku->update([
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'kategori'    => $namaKategori,
            'kategori_id' => $request->idKategori,
        ]);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus data buku.
     * [OOP CONCEPT: Object Lifecycle Termination]
     */
    public function destroy($id)
    {
        Buku::findOrFail($id)->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    // ==========================================
    // ALUR PENGEMBALIAN BUKU
    // ==========================================

    /**
     * Dijalankan oleh ANGGOTA: Mengajukan pengembalian buku.
     * [OOP CONCEPT: Authorization & Encapsulation of Business Logic]
     */
    public function ajukanPengembalian($idPinjam)
    {
        $peminjaman = Peminjaman::findOrFail($idPinjam);

        // Memastikan hanya pemilik transaksi (instance user terkait) yang bisa mengajukan
        if ($peminjaman->user_id !== auth()->id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        // Mutasi status transaksi
        $peminjaman->update([
            'status' => 'Menunggu Konfirmasi'
        ]);

        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim. Silakan serahkan buku ke petugas admin.');
    }

    /**
     * Dijalankan oleh ADMIN: Mengonfirmasi pengembalian buku.
     * [OOP CONCEPT: Collaboration / Interaction between Multiple Class Objects]
     */
    public function konfirmasiPengembalian($idPinjam)
    {
        // 1. Dapatkan instance Peminjaman
        $peminjaman = Peminjaman::findOrFail($idPinjam);
        $tglKembali = now();

        // 2. [OOP CONCEPT: Delegation / Method Invocation]
        // Menggunakan behavior (method) dari class Peminjaman untuk menghitung durasi dan denda
        $lamaPinjam = $peminjaman->hitungLamaPinjam();
        $terlambat  = max(0, $lamaPinjam - 7);
        $denda      = $peminjaman->hitungDenda($terlambat);

        // 3. Update status transaksi peminjaman
        $peminjaman->update([
            'status'         => 'Kembali',
            'tanggalKembali' => $tglKembali->toDateString(),
            'denda'          => $denda
        ]);

        // 4. [OOP CONCEPT: Object Association / Relationship Communication]
        // Memanggil method `updateStatus()` yang ada pada objek terelasi `buku`
        $peminjaman->buku->updateStatus('Tersedia');

        return back()->with('success', 'Pengembalian buku berhasil dikonfirmasi!');
    }
}

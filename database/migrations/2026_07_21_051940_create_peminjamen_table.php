<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('idPinjam');
            $table->foreignId('buku_id')->references('idBuku')->on('bukus')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggalPinjam');
            $table->date('tanggalKembali')->nullable();
            $table->enum('status', ['Dipinjam', 'Kembali'])->default('Dipinjam');
            $table->double('denda')->default(0); // Sesuai tipe double pada deskripsi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};

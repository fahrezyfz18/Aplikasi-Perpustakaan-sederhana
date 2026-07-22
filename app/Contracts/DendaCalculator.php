<?php

namespace App\Contracts;

/*
<-- Interface DendaCalculator -->
OOP Concept: INTERFACE (Abstraction & Contract)
Interface ini digunakan sebagai kontrak.
Setiap class yang mengimplementasikan interface ini
wajib memiliki method hitungDenda().
*/

interface DendaCalculator
{
    /*
    <-- Method Hitung Denda -->
    Menghitung total denda berdasarkan jumlah
    hari keterlambatan.
    */
    public function hitungDenda(int $jumlahHariTerlambat): float;
}
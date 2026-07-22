<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/*
<-- Abstract Class Pengguna -->
OOP Concept: ABSTRACTION & INHERITANCE
Class ini merupakan parent class
untuk Admin dan Anggota.
Class abstract tidak dapat dibuat object secara langsung, melainkan diturunkan ke Admin/Anggota.
*/

abstract class Pengguna extends Authenticatable
{
    /*
    <-- Method Abstract -->
    OOP Concept: POLYMORPHISM
    Method ini wajib dibuat ulang (override)
    oleh setiap subclass.
    */
    abstract public function aksesMenu();

    /*
    <-- Method Biasa -->
    OOP Concept: ENCAPSULATION / REUSABILITY
    Method ini dapat digunakan
    oleh seluruh subclass.
    */
    public function tampilIdentitas()
    {
        return "Nama : " . $this->name;
    }
}
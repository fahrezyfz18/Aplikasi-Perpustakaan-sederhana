<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Anggota 1',
            'email' => 'anggota@gmail.com',
            'password' => Hash::make('anggota123'),
            'role' => 'anggota',
            'nomorAnggota' => 'A001',
            'maxPinjam' => 3
        ]);
    }
}

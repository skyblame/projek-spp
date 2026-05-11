<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas; // Panggil model Petugas
use Illuminate\Support\Facades\Hash; // Panggil fungsi enkripsi password

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'), // Password akan dienkripsi
            'nama_petugas' => 'Administrator Utama',
            'level' => 'admin'
        ]);
    }
}
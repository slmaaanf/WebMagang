<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'institution' => 'Universitas A', // Tambahkan nilai institution
            'major' => 'Ilmu Komputer', // Tambahkan nilai major
            'nik' => '1234567890123456', // Tambahkan nilai NIK (harus unik)
            'phone' => '081234567890', // Tambahkan nomor HP
            'role' => 'admin', // Bisa disesuaikan
        ]);
    }
}

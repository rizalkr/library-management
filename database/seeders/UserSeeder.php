<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Hapus data user sebelumnya jika diperlukan
                // User::truncate();

                // Tambahkan user baru ke dalam tabel
                User::insert([
                    [
                        'username' => 'admin',
                    'password' => Hash::make('123'), // Pastikan untuk melakukan hashing pada password
                        'address' => 'Alamat User 1',
                        'role_id' => 1, // Ganti dengan ID role yang sesuai
                    ],
                    [
                        'username' => 'to',
                        'password' => Hash::make('123'),
                        'address' => 'Alamat User 2',
                        'role_id' => 2,
                    ],
                    // Tambahkan user lainnya sesuai kebutuhan
                ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => '0', // Admin tidak terikat cabang
            'role' => 'admin',
        ]);

        // Kepala Cabang
        User::create([
            'name' => 'Kepala Cabang Karawaci',
            'username' => 'kepala_cabang1',
            'email' => 'kepala_cabang1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => 'TVKCI',
            'role' => 'kepala_cabang',
        ]);

        // Supervisor
        User::create([
            'name' => 'Supervisor Karawaci',
            'username' => 'supervisor1',
            'email' => 'supervisor1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => 'TVKCI',
            'role' => 'supervisor',
        ]);

        // Salesman
        User::create([
            'name' => 'Budi',
            'username' => 'salesman1',
            'email' => 'salesman1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => 'TVKCI',
            'role' => 'salesman',
        ]);
    }
}

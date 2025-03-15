<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Branch;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role sudah ada di database
        $roles = ['admin', 'kepala_cabang', 'supervisor', 'salesman'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Admin (tidak memiliki id_cabang)
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => null, // Admin tidak memiliki cabang
        ]);
        $admin->assignRole('admin');

        // Ambil salah satu cabang untuk kepala cabang, supervisor, dan salesman
        $branch = Branch::first(); // Ambil cabang pertama (pastikan tabel branches ada data)

        // Kepala Cabang
        $kepalaCabang = User::create([
            'name' => 'Kepala Cabang Jakarta',
            'username' => 'kepala_cabang1',
            'email' => 'kepala_cabang1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => $branch ? $branch->id : null,
        ]);
        $kepalaCabang->assignRole('kepala_cabang');

        // Supervisor
        $supervisor = User::create([
            'name' => 'Supervisor Jakarta',
            'username' => 'supervisor1',
            'email' => 'supervisor1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => $branch ? $branch->id : null,
        ]);
        $supervisor->assignRole('supervisor');

        // Salesman
        $salesman = User::create([
            'name' => 'Budi Salesman',
            'username' => 'salesman1',
            'email' => 'salesman1@example.com',
            'password' => Hash::make('password123'),
            'id_cabang' => $branch ? $branch->id : null,
        ]);
        $salesman->assignRole('salesman');

        echo "UserSeeder berhasil dijalankan!\n";
    }
}

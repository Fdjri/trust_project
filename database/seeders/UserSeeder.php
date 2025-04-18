<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat user dan memberikan role
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        $admin->assignRole('admin');

        // Kepala Cabang
        $kepalaCabang = User::create([
            'name' => 'Kepala Cabang',
            'username' => 'kepalacabang1',
            'email' => 'kc1@example.com',
            'password' => bcrypt('password123'),
        ]);
        $kepalaCabang->assignRole('kepala_cabang');

        // Supervisor
        $supervisor = User::create([
            'name' => 'Supervisor Cabang',
            'username' => 'supervisor1',
            'email' => 'supervisor1@example.com',
            'password' => bcrypt('password123'),
        ]);
        $supervisor->assignRole('supervisor');

        // Salesman
        $salesman = User::create([
            'name' => 'Salesman Cabang',
            'username' => 'salesman1',
            'email' => 'salesman1@example.com',
            'password' => bcrypt('password123'),
        ]);
        $salesman->assignRole('salesman');
    }
}

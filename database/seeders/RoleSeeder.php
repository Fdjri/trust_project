<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat role
        $admin = Role::create(['name' => 'admin']);
        $kepalaCabang = Role::create(['name' => 'kepala_cabang']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $salesman = Role::create(['name' => 'salesman']);

        // Buat permission
        $permissions = [
            'manage users',
            'manage customers',
            'view dashboard',
            'create order',
            'approve order',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Berikan permission ke role
        $admin->givePermissionTo(Permission::all());
        $kepalaCabang->givePermissionTo(['view dashboard', 'manage customers']);
        $supervisor->givePermissionTo(['view dashboard', 'approve order']);
        $salesman->givePermissionTo(['view dashboard', 'create order']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan role belum ada sebelum membuatnya
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $kepalaCabangRole = Role::firstOrCreate(['name' => 'kepala_cabang', 'guard_name' => 'web']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor', 'guard_name' => 'web']);
        $salesmanRole = Role::firstOrCreate(['name' => 'salesman', 'guard_name' => 'web']);
    }
}

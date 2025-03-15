<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            ['id' => 'TVBDG', 'name' => 'BANDENGAN'],
            ['id' => 'TVBKS', 'name' => 'BEKASI'],
            ['id' => 'TVBLP', 'name' => 'HARMONI'],
            ['id' => 'TVBTG', 'name' => 'BITUNG'],
            ['id' => 'TVBTL', 'name' => 'BATU TULIS'],
            ['id' => 'TVCLI', 'name' => 'CILEUNGSI'],
            ['id' => 'TVFWT', 'name' => 'FATMAWATI'],
            ['id' => 'TVKCI', 'name' => 'KARAWACI'],
            ['id' => 'TVKGV', 'name' => 'KELAPA GADING V'],
            ['id' => 'TVKJR', 'name' => 'KEBON JERUK'],
            ['id' => 'TVKLD', 'name' => 'KLENDER'],
            ['id' => 'TVKRW', 'name' => 'KARAWANG'],
            ['id' => 'TVMED', 'name' => 'KELAPA GADING VSP'],
            ['id' => 'TVPDG', 'name' => 'PONDOK GEDE'],
            ['id' => 'TVPDC', 'name' => 'PONDOK CABE'],
            ['id' => 'TVPIN', 'name' => 'PONDOK INDAH'],
            ['id' => 'TVTGR', 'name' => 'TANGERANG'],
            ['id' => 'TVYOS', 'name' => 'YOS SUDARSO'],
            ['id' => 'TRUST', 'name' => 'TRADE IN'],
        ];

        DB::table('branches')->insert($branches);
    }
}

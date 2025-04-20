<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['level_id' => 1, 'level_kode' => 'ADM', 'level_nama' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['level_id' => 2, 'level_kode' => 'STF', 'level_nama' => 'Kasir', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('m_level')->insert($data);
    }
}

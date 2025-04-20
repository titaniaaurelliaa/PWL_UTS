<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'ACT',
                'kategori_nama' => 'Action'
            ],

            [
                'kategori_id' => 2,
                'kategori_kode' => 'ANM',
                'kategori_nama' => 'Animation'
            ],

            [
                'kategori_id' => 3,
                'kategori_kode' => 'ROM',
                'kategori_nama' => 'Romance'
            ],

            [
                'kategori_id' => 4,
                'kategori_kode' => 'FAN',
                'kategori_nama' => 'Fantasy'
            ],

            [
                'kategori_id' => 5,
                'kategori_kode' => 'HOR',
                'kategori_nama' => 'Horror'
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}

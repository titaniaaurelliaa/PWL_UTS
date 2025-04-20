<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'film_id' => 1,
                'kategori_id' => 1,
                'film_kode' => 'F001',
                'film_nama' => 'The Avengers',
                'harga_jual' => 100000,
            ],
            [
                'film_id' => 2,
                'kategori_id' => 2,
                'film_kode' => 'F002',
                'film_nama' => 'Toy Story',
                'harga_jual' => 80000,
            ],
            [
                'film_id' => 3,
                'kategori_id' => 3,
                'film_kode' => 'F003',
                'film_nama' => 'La La Land',
                'harga_jual' => 60000,
            ],
            [
                'film_id' => 4,
                'kategori_id' => 4,
                'film_kode' => 'F004',
                'film_nama' => 'The Lord of the Rings',
                'harga_jual' => 90000,
            ],
            [
                'film_id' => 5,
                'kategori_id' => 5,
                'film_kode' => 'F005',
                'film_nama' => 'The Godfather',
                'harga_jual' => 50000,
            ]
        ];
        DB::table('m_film')->insert($data);
    }
}

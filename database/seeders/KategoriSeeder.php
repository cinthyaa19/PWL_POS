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
                'kategori_kode' => 01,
                'kategori_nama' => 'Obat-obatan'
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 02,
                'kategori_nama' => 'Sayur dan Buah'
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 03,
                'kategori_nama' => 'Alat Tulis'
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 04,
                'kategori_nama' => 'Makanan'
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 05,
                'kategori_nama' => 'Minuman'
            ],
        ];

        DB::table('m_kategoris')->insert($data);
    }
}

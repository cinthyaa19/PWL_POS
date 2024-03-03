<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => '1',
                'barang_nama' => 'Betadine',
                'harga_beli' => 15000,
                'harga_jual' => 17000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => '2',
                'barang_nama' => 'Vitamin C',
                'harga_beli' => 25000,
                'harga_jual' => 28000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => '3',
                'barang_nama' => 'Kangkung',
                'harga_beli' => 2000,
                'harga_jual' => 3000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => '4',
                'barang_nama' => 'Apel',
                'harga_beli' => 20000,
                'harga_jual' => 23000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => '5',
                'barang_nama' => 'Buku Tulis',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => '6',
                'barang_nama' => 'Pensil',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => '7',
                'barang_nama' => 'Keripik Singkong',
                'harga_beli' => 7000,
                'harga_jual' => 9000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => '8',
                'barang_nama' => 'Roti',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => '9',
                'barang_nama' => 'Air Mineral',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => '10',
                'barang_nama' => 'Susu Strawberry',
                'harga_beli' => 6000,
                'harga_jual' => 7000,
            ]
        ];

        DB::table('m_barangs')->insert($data);
    }
}

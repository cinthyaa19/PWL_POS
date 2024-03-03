<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Data transaksi 1
        $data[] = [
            'user_id' => 1,
            'pembeli' => 'Putri',
            'penjualan_kode' => 'PJ0001',
            'penjualan_tanggal' => now(),
        ];

        // Data transaksi 2
        $data[] = [
            'user_id' => 2,
            'pembeli' => 'Rian',
            'penjualan_kode' => 'PJ0002',
            'penjualan_tanggal' => now()->subDays(1),
        ];

        // Data transaksi 3
        $data[] = [
            'user_id' => 3,
            'pembeli' => 'Bunga',
            'penjualan_kode' => 'PJ0003',
            'penjualan_tanggal' => now()->subDays(2),
        ];

        // Data transaksi 4
        $data[] = [
            'user_id' => 1,
            'pembeli' => 'Alice',
            'penjualan_kode' => 'PJ0004',
            'penjualan_tanggal' => now()->subDays(3),
        ];

        // Data transaksi 5
        $data[] = [
            'user_id' => 2,
            'pembeli' => 'David',
            'penjualan_kode' => 'PJ0005',
            'penjualan_tanggal' => now()->subDays(4),
        ];

        // Data transaksi 6
        $data[] = [
            'user_id' => 3,
            'pembeli' => 'Sarah',
            'penjualan_kode' => 'PJ0006',
            'penjualan_tanggal' => now()->subDays(5),
        ];

        // Data transaksi 7
        $data[] = [
            'user_id' => 1,
            'pembeli' => 'Kevin',
            'penjualan_kode' => 'PJ0007',
            'penjualan_tanggal' => now()->subDays(6),
        ];

        // Data transaksi 8
        $data[] = [
            'user_id' => 2,
            'pembeli' => 'Luna',
            'penjualan_kode' => 'PJ0008',
            'penjualan_tanggal' => now()->subDays(7),
        ];

        // Data transaksi 9
        $data[] = [
            'user_id' => 3,
            'pembeli' => 'Dani',
            'penjualan_kode' => 'PJ0009',
            'penjualan_tanggal' => now()->subDays(8),
        ];

        // Data transaksi 10
        $data[] = [
            'user_id' => 1,
            'pembeli' => 'Citra',
            'penjualan_kode' => 'PJ0010',
            'penjualan_tanggal' => now()->subDays(9),
        ];

        DB::table('t_penjualans')->insert($data);
    }
}

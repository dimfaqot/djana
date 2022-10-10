<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tgl' => date('d-m-Y H:i:s'),
                'penerima_order' => 'Syaiful',
                'pj_order' => "Alib",
                'produk' => "Komputer",
                'harga' => 1798987,
                'qty' => 1,
                'jumlah' => 1798987,
                'catatan' => 'Pemesan Jayadi warna barang merah',
                'progres' => 'Menunggu',
                'uang_keluar' => 500000,
                'ket_uangkeluar' => 'Dp',
                'pj_uangkeluar' => 'Ibnu',
                'nota_uangkeluar' => 'nota.jpg',
                'uang_masuk' => 700000,
                'penerima_uangmasuk' => 'Ibnu',
                'ket_uangmasuk' => 'Dp'
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('transaksi')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeranjangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'barang_id' => 1,
                'tgl_keranjang' => date("d-m-Y H:i:s"),
            ],
            [
                'user_id' => 1,
                'barang_id' => 2,
                'tgl_keranjang' => date("d-m-Y H:i:s")
            ],
            [
                'user_id' => 1,
                'barang_id' => 3,
                'tgl_keranjang' => date("d-m-Y H:i:s")
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('keranjang')->insertBatch($data);
    }
}

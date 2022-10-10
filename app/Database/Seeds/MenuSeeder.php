<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff,User,Guest',
                'menu' => 'User',
                'icon' => "fa fa-tachometer"
            ],
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff,User,Guest',
                'menu' => 'Produk',
                'icon' => "fa fa-shopping-cart"
            ],
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff,User,Guest',
                'menu' => 'Transaksi',
                'icon' => "fa fa-truck"
            ],
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff',
                'menu' => 'Tugas',
                'icon' => "fa fa-star"
            ],
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff',
                'menu' => 'Inventaris',
                'icon' => "fa fa-star"
            ],
            [
                'role' => 'Root,Bendahara,Admin,Editor,Staff,User',
                'menu' => 'Peminjaman',
                'icon' => "fa fa-tachometer"
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('menu')->insertBatch($data);
    }
}

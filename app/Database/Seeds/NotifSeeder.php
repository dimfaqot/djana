<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotifSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tgl' => date("d-m-Y H:i:s"),
                'subjek' => 'Dimyati',
                'order' => 'update',
                'tabel' => 'Keranjang',
                'target_id' => 3,
                'read' => ''
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('notif')->insertBatch($data);
    }
}

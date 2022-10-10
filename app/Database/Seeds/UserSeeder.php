<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'fqt',
                'nama' => 'Dimyati',
                'alias' => "Fqt",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Root'
            ],
            [
                'username' => 'agus',
                'nama' => 'Agus',
                'alias' => "Agu",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Admin'
            ],
            [
                'username' => 'ihsanuddin',
                'nama' => 'Ihsanuddin',
                'alias' => "Ihs",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Bendahara'
            ],
            [
                'username' => 'fajar',
                'nama' => 'Fajar',
                'alias' => "Faj",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Admin'
            ],
            [
                'username' => 'iqbal',
                'nama' => 'Iqbal',
                'alias' => "Iqb",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Admin'
            ],
            [
                'username' => 'syaiful',
                'nama' => 'Syaiful',
                'alias' => "Sya",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Editor'
            ],
            [
                'username' => 'alib',
                'nama' => 'Alib',
                'alias' => "Ali",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Editor'
            ],
            [
                'username' => 'ibnu',
                'nama' => 'Ibnu',
                'alias' => "Ibn",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Editor'
            ],
            [
                'username' => 'alvin',
                'nama' => 'Alvin',
                'alias' => "Alv",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'Editor'
            ],
            [
                'username' => 'dimas',
                'nama' => 'Dimas',
                'alias' => "Dim",
                'sub' => "Djana",
                'image' => 'default.jpg',
                'password' => password_hash(123456, PASSWORD_DEFAULT),
                'role' => 'User'
            ]


        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('user')->insertBatch($data);
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'alias' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'sub' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}

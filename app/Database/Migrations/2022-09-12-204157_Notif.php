<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notif extends Migration
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
            'tgl' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'subjek' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'objek' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'order' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tabel' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'target_id' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'read' => [
                'type' => 'VARCHAR',
                'constraint' => 5000
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('notif');
    }

    public function down()
    {
        $this->forge->dropTable('notif');
    }
}

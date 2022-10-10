<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inv extends Migration
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
                'constraint' => 120
            ],
            'petugas' => [
                'type' => 'VARCHAR',
                'constraint' => 120
            ],
            'no_inv' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'barang' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'toko' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'kondisi' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('inv');
    }

    public function down()
    {
        $this->forge->dropTable('inv');
    }
}

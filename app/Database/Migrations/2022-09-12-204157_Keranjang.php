<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'produk_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'catatan_keranjang' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'quantity_keranjang' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'pilih' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('keranjang');
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}

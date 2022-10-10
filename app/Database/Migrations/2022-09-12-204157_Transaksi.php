<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
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
            'no_nota' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'tgl' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'penerima_order' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'pj_order' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'produk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 5000
            ],
            'progres' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'uang_modal' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'tgl_uangkeluar' => [
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'uang_keluar' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'ket_uangkeluar' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'pj_uangkeluar' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'nota_uangkeluar' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tgl_uangmasuk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'uang_masuk' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'penerima_uangmasuk' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'ket_uangmasuk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tgl_diterimabendahara' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ket' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}

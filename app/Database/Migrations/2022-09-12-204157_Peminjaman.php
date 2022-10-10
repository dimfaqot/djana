<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
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
            'id_peminjam' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'peminjam' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'petugas' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tgl' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'no_inv' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'barang_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'barang' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'jml' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'biaya' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'penerima_uang' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tgl_dikembalikan' => [
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
            ],
            'ket' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}

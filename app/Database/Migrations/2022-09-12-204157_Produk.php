<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
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
            'petugas_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'produk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'harga_beli' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harga_jual' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harga_beli_sebelum' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harga_jual_sebelum' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'link_pembelian' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'detail_produk' => [
                'type' => 'TEXT'
            ],
            'created_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'updated_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}

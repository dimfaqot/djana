<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'penginput' => 1,
                'jenis' => 'Hp',
                'produk' => "Monitor AOC 24 Inch",
                'gambar' => "produk.jpg",
                'harga_beli' => 1798987,
                'harga_jual' => 1800000,
                'link_pembelian' => 'https://www.tokopedia.com/ptagi/monitor-led-aoc-24b2xhm-24-va-1080p-75hz-vga-hdmi-vesa-24b2xhm?extParam=ivf%3Dfalse%26whid%3D14112008',
                'detail_produk' => "Brand Type : 24B2XHM Panel Size(Inch) : 24 Panel Type : VA Panel Resolution : 1920x1080 Aspect Ratio : 16:9",
                'created_produk' => date('d-m-Y H:i:s'),
                'updated_produk' => date('d-m-Y H:i:s')
            ],
            [
                'penginput' => 1,
                'jenis' => 'Komputer',
                'produk' => "Monitor AOC 24 Inch",
                'gambar' => "produk.jpg",
                'harga_beli' => 1798987,
                'harga_jual' => 1800000,
                'link_pembelian' => 'https://www.tokopedia.com/ptagi/monitor-led-aoc-24b2xhm-24-va-1080p-75hz-vga-hdmi-vesa-24b2xhm?extParam=ivf%3Dfalse%26whid%3D14112008',
                'detail_produk' => "Brand Type : 24B2XHM Panel Size(Inch) : 24 Panel Type : VA Panel Resolution : 1920x1080 Aspect Ratio : 16:9",
                'created_produk' => date('d-m-Y H:i:s'),
                'updated_produk' => date('d-m-Y H:i:s')
            ],
            [
                'penginput' => 1,
                'jenis' => 'Laptop',
                'produk' => "Monitor AOC 24 Inch",
                'gambar' => "produk.jpg",
                'harga_beli' => 1798987,
                'harga_jual' => 1800000,
                'link_pembelian' => 'https://www.tokopedia.com/ptagi/monitor-led-aoc-24b2xhm-24-va-1080p-75hz-vga-hdmi-vesa-24b2xhm?extParam=ivf%3Dfalse%26whid%3D14112008',
                'detail_produk' => "Brand Type : 24B2XHM Panel Size(Inch) : 24 Panel Type : VA Panel Resolution : 1920x1080 Aspect Ratio : 16:9",
                'created_produk' => date('d-m-Y H:i:s'),
                'updated_produk' => date('d-m-Y H:i:s')
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('produk')->insertBatch($data);
    }
}

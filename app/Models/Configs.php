<?php

namespace App\Models;

use CodeIgniter\Model;

class Configs extends Model
{

    // foreach ($tabel as $i) {
    //     $t = firstWordUpCase($tabel) . 's';

    //     $module = "App\\Models\\" . $t;
    //     $model = new $module();
    //     $res = $model->cols();
    // }

    // return $res;
    // $mod = \App\Models\Produks::class;
    // $mod = new $mod;
    public function tabel()
    {
        $res = ['keranjang', 'menu', 'produk', 'user'];
        return $res;
    }

    public function notif()
    {
        $tabel = $this->tabel();
        $notif = [];

        foreach ($tabel as $i) {
            $db      = \Config\Database::connect();
            $db = $db->table($i);
            $q = $db->where('notif_' . $i, 1)->get()->getResultArray();
            if (count($q) > 0) {
                foreach ($q as $d) {
                    $read = 0;
                    $exp = explode(",", $d['read_' . $i]);
                    if (in_array(session('id'), $exp)) {
                        $read = 1;
                    }
                    $notif[] = [
                        'tgl' => $d['update_' . $i],
                        'read' => $read,
                        'petugas' => $d['petugas_' . $i],
                        'tabel' => $i,
                        'id' => $d['id'],
                        'ket' => $d['ket_' . $i]
                    ];
                }
            }
        }

        return $notif;
    }

    public function tables()
    {
        $db = db_connect();

        $tables = $db->listTables();
        return $tables;
    }

    public function cols($tabel)
    {
        helper('functions');
        $t = firstWordUpCase($tabel);
        if ($tabel !== 'akses' && $tabel !== 'sk' && $tabel !== 'kelas' && $tabel !== 'anggotakelas') {
            $t = firstWordUpCase($tabel) . 's';
        }
        $module = "App\\Models\\" . $t;
        $model = new $module();
        $res = $model->cols();
        return $res;
    }

    public function jenis()
    {
        $res = ['Komputer', 'Laptop', 'Elektronik', 'Desain', 'Cetak', 'Pembayaran', 'Service', 'Install', 'Persewaan', 'Editing'];

        return $res;
    }

    public function role()
    {
        $res = ['Root', 'Bendahara', 'Admin', 'Editor', 'Staff', 'User', 'Guest'];

        return $res;
    }

    public function tahun()
    {
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->orderBy('tgl', 'DESC')->findAll();


        $tahun = [];

        foreach ($q as $i) {

            $exp = explode(' ', $i['tgl']);
            $exp = explode("-", $exp[0]);

            if (!in_array($exp[2], $tahun)) {
                $tahun[] = $exp[2];
            }
        }

        return $tahun;
    }

    public function bulan($tahun = null)
    {
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->orderBy('tgl', 'ASC')->findAll();

        $arrbl = [];
        $bulan = [];

        foreach ($q as $i) {

            $exp = explode(' ', $i['tgl']);
            $exp = explode("-", $exp[0]);

            if (!in_array($exp[1], $arrbl)) {
                $arrbl[] = $exp[1];
                $bl = 'Januari';
                if ($exp[1] == 2) {
                    $bl = 'Februari';
                }
                if ($exp[1] == 3) {
                    $bl = 'Maret';
                }
                if ($exp[1] == 4) {
                    $bl = 'April';
                }
                if ($exp[1] == 5) {
                    $bl = 'Mei';
                }
                if ($exp[1] == 6) {
                    $bl = 'Juni';
                }
                if ($exp[1] == 7) {
                    $bl = 'Juli';
                }
                if ($exp[1] == 8) {
                    $bl = 'Agustus';
                }
                if ($exp[1] == 9) {
                    $bl = 'September';
                }
                if ($exp[1] == 10) {
                    $bl = 'Oktober';
                }
                if ($exp[1] == 11) {
                    $bl = 'November';
                }
                if ($exp[1] == 12) {
                    $bl = 'Desember';
                }
                if ($tahun == null) {
                    $bulan[] = [
                        'bulan' => $bl,
                        'angka' => $exp[1]
                    ];
                } else {
                    if ($tahun == $exp[2]) {
                        $bulan[] = [
                            'bulan' => $bl,
                            'angka' => $exp[1]
                        ];
                    }
                }
            }
        }
        return $bulan;
    }

    public function bulans($angka = null)
    {
        $res = [
            ['bulan' => 'Januari', 'angka' => 1],
            ['bulan' => 'Februari', 'angka' => 2],
            ['bulan' => 'Maret', 'angka' => 3],
            ['bulan' => 'April', 'angka' => 4],
            ['bulan' => 'Mei', 'angka' => 5],
            ['bulan' => 'Juni', 'angka' => 6],
            ['bulan' => 'Juli', 'angka' => 7],
            ['bulan' => 'Agustus', 'angka' => 8],
            ['bulan' => 'September', 'angka' => 9],
            ['bulan' => 'Oktober', 'angka' => 10],
            ['bulan' => 'November', 'angka' => 11],
            ['bulan' => 'Desember', 'angka' => 12]
        ];

        if ($angka !== null) {

            foreach ($res as $i) {
                if ($i['angka'] == $angka) {
                    return $i['bulan'];
                }
            }
        }

        return $res;
    }

    public function kondisi()
    {
        $res = ['Baik', 'Dipinjam', 'Service',  'Rusak',];
        return $res;
    }

    public function djana()
    {
        $db = \App\Models\Users::class;
        $db = new $db;

        $where = ['User', 'Guest'];
        $q = $db->whereNotIn('role', $where)->find();
        return $q;
    }

    public function progres()
    {
        $progres = [
            ['color' => 'bg-danger', 'icon' => '<i class="fa fa-spinner"></i>', 'text' => 'Menunggu'],
            ['color' => 'bg-warning', 'icon' => '<i class="fa fa-space-shuttle"></i>', 'text' => 'Proses'],
            ['color' => 'bg-info', 'icon' => '<i class="fa fa-money"></i>', 'text' => 'Pembayaran'],
            ['color' => 'bg-success', 'icon' => '<i class="fa fa-check-circle"></i>', 'text' => 'Selesai']
        ];
        return $progres;
    }
}

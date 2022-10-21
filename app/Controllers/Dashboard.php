<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends BaseController
{
    function __construct()
    {
        $session = session('id');
        if (!$session) {
            session()->setFlashdata('gagal', 'Anda belum login!.');
            header("Location: " . base_url());
            die;
        }
    }
    public function index()
    {
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $con = \App\Models\Configs::class;
        $con = new $con;

        $where = ['Selesai'];
        $q = $transaksi->where('username', session('username'))->whereNotIn('progres', $where)->find();
        $data = [
            'judul' => 'Home',
            'data' => $q,
            'tahun' => $con->tahun(),
            'bulan' => $con->bulans(),
            'progres' => $con->progres()
        ];
        // dd($data);
        return view('dashboard', $data);
    }

    public function transaksi()
    {
        helper('functions');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $progres = $this->request->getVar('progres');

        $con = \App\Models\Configs::class;
        $con = new $con;

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;
        if ($progres == 'Semua') {
            $q = $transaksi->orderBy('tgl', 'ASC')->findAll();
        } else {
            $where = [$progres];
            $q = $transaksi->orderBy('tgl', 'ASC')->whereIn('progres', $where)->find();
        }
        $keluar = 0;
        $masuk = 0;
        $res = [];

        if ($tahun == 'Semua' && $bulan == 'Semua') {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);
                $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                $keluar = $keluar + $i['uang_keluar'];
                $masuk = $masuk + $i['uang_masuk'];
                $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                $i['tahun'] = $exp[2];
                $i['bulan'] = $con->bulans($exp[1]);
                $i['uang_keluar'] = rupiah($i['uang_keluar']);
                $i['uang_masuk'] = rupiah($i['uang_masuk']);


                $res[] = $i;
            }
        } else if ($tahun == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $exp[2];
                    $i['bulan'] = $con->bulans($bulan);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);


                    $res[] = $i;
                }
            }
        } else if ($bulan == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($exp[1]);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);



                    $res[] = $i;
                }
            }
        } else {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan && $exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($bulan);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);

                    $res[] = $i;
                }
            }
        }

        $val = [
            'status' => '200',
            'data' => $res,
            'keluar' => rupiah($keluar),
            'masuk' => rupiah($masuk),
            'laba' => rupiah($masuk - $keluar)
        ];

        echo json_encode($val);
        die;
    }

    public function pdf($tahun, $bulan, $progres)
    {
        helper('functions');


        $con = \App\Models\Configs::class;
        $con = new $con;

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        if ($progres == 'Semua') {
            $q = $transaksi->orderBy('tgl', 'ASC')->findAll();
        } else {
            $where = [$progres];
            $q = $transaksi->orderBy('tgl', 'ASC')->whereIn('progres', $where)->find();
        }


        $keluar = 0;
        $masuk = 0;
        $res = [];

        if ($tahun == 'Semua' && $bulan == 'Semua') {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);
                $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                $keluar = $keluar + $i['uang_keluar'];
                $masuk = $masuk + $i['uang_masuk'];
                $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                $i['tahun'] = $exp[2];
                $i['bulan'] = $con->bulans($exp[1]);
                $i['uang_keluar'] = rupiah($i['uang_keluar']);
                $i['uang_masuk'] = rupiah($i['uang_masuk']);


                $res[] = $i;
            }
        } else if ($tahun == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $exp[2];
                    $i['bulan'] = $con->bulans($bulan);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);


                    $res[] = $i;
                }
            }
        } else if ($bulan == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($exp[1]);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);



                    $res[] = $i;
                }
            }
        } else {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan && $exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($bulan);
                    $i['uang_keluar'] = rupiah($i['uang_keluar']);
                    $i['uang_masuk'] = rupiah($i['uang_masuk']);



                    $res[] = $i;
                }
            }
        }
        $bln = $con->bulans($bulan);
        if ($bulan == 'Semua') {
            $bln = 'Semua';
        }
        $data = [
            'tahun' => $tahun,
            'bulan' => $bln,
            'data' => $res,
            'keluar' => rupiah($keluar),
            'masuk' => rupiah($masuk),
            'laba' => rupiah($masuk - $keluar)
        ];


        $set = [
            'mode' => 'utf-8',
            'format' => [215, 330],
            'orientation' => 'L'
        ];

        $mpdf = new \Mpdf\Mpdf($set);

        $html = view('laporanpdf', $data);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Laporan Djana.pdf', 'I');
    }

    public function excel($tahun, $bulan, $progres)
    {
        helper('functions');


        $con = \App\Models\Configs::class;
        $con = new $con;

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;
        if ($progres == 'Semua') {
            $q = $transaksi->orderBy('tgl', 'ASC')->findAll();
        } else {
            $where = [$progres];
            $q = $transaksi->orderBy('tgl', 'ASC')->whereIn('progres', $where)->find();
        }
        $keluar = 0;
        $masuk = 0;
        $res = [];

        if ($tahun == 'Semua' && $bulan == 'Semua') {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);
                $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                $keluar = $keluar + $i['uang_keluar'];
                $masuk = $masuk + $i['uang_masuk'];
                $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                $i['tahun'] = $exp[2];
                $i['bulan'] = $con->bulans($exp[1]);


                $res[] = $i;
            }
        } else if ($tahun == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $exp[2];
                    $i['bulan'] = $con->bulans($bulan);


                    $res[] = $i;
                }
            }
        } else if ($bulan == 'Semua') {

            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($exp[1]);



                    $res[] = $i;
                }
            }
        } else {
            foreach ($q as $i) {
                $exp = explode(" ", $i['tgl']);
                $exp = explode("-", $exp[0]);

                if ($exp[1] == $bulan && $exp[2] == $tahun) {
                    $i['laba'] = rupiah((int)$i['uang_masuk'] - (int)$i['uang_keluar']);
                    $i['untung'] = (int)$i['uang_masuk'] - (int)$i['uang_keluar'];
                    $i['tgl'] = $exp[0] . '/' . $exp[1] . '/' . $exp[2];
                    $keluar = $keluar + $i['uang_keluar'];
                    $masuk = $masuk + $i['uang_masuk'];
                    $i['tahun'] = $tahun;
                    $i['bulan'] = $con->bulans($bulan);



                    $res[] = $i;
                }
            }
        }
        $bln = $con->bulans($bulan);
        if ($bulan == 'Semua') {
            $bln = 'Semua';
        }
        $data = [
            'tahun' => $tahun,
            'bulan' => $bln,
            'data' => $res,
            'keluar' => rupiah($keluar),
            'masuk' => rupiah($masuk),
            'laba' => rupiah($masuk - $keluar)
        ];


        $filename = 'Laporan Djana.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $props = [
            ['col' => 'tgl', 'label' => 'Tgl'],
            ['col' => 'no_nota', 'label' => 'No. Nota'],
            ['col' => 'username', 'label' => 'Penerima Order'],
            ['col' => 'pj_order', 'label' => 'Pj Order'],
            ['col' => 'produk', 'label' => 'Produk'],
            ['col' => 'harga', 'label' => 'Harga'],
            ['col' => 'qty', 'label' => 'Qty'],
            ['col' => 'jumlah', 'label' => 'Jml.'],
            ['col' => 'uang_modal', 'label' => 'Uang Modal'],
            ['col' => 'tgl_uangkeluar', 'label' => 'Tgl. Uang Keluar'],
            ['col' => 'uang_keluar', 'label' => 'Uang Keluar'],
            ['col' => 'ket_uangkeluar', 'label' => 'Ket. Uang Keluar'],
            ['col' => 'pj_uangkeluar', 'label' => 'Pj. Uang Keluar'],
            ['col' => 'nota_uangkeluar', 'label' => 'Nota Uang Keluar'],
            ['col' => 'tgl_uangmasuk', 'label' => 'Tgl. Uang Masuk'],
            ['col' => 'uang_masuk', 'label' => 'Uang Masuk'],
            ['col' => 'ket_uangmasuk', 'label' => 'Ket. Uang Masuk'],
            ['col' => 'penerima_uangmasuk', 'label' => 'Pj. Uang Masuk'],
            ['col' => 'tgl_diterimabendahara', 'label' => 'Tgl. Diterima Bendahara'],
            ['col' => 'catatan', 'label' => 'Catatan'],
            ['col' => 'progres', 'label' => 'Progres'],
            ['col' => 'ket', 'label' => 'Ket']
        ];

        $huruf = 'AAZ';

        foreach ($props as $p) {
            $huruf++;
            $sheet->setCellValue(substr($huruf, -1) . '1', $p['label']);
        }

        $rows = 2;
        $huruf = 'AAZ';
        foreach ($data['data'] as $i) {
            foreach ($props as $p) {
                $huruf++;
                $sheet->setCellValue(substr($huruf, -1) . $rows, $i[$p['col']]);
            }
            $huruf = 'AAZ';
            $rows++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: maxe-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}

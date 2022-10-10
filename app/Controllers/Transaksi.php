<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    function __construct()
    {
        $session = session('id');
        if (!$session) {
            session()->setFlashdata('gagal', 'Anda belum login!.');
            header("Location: " . base_url());
            die;
        } else {
            helper('functions');
            $request = \Config\Services::request();
            $url = $request->uri->getSegment(1);
            if (!menu(ucfirst($url))) {
                session()->setFlashdata('gagal', 'Hak akses ditolak!.');
                header("Location: " . base_url('dashboard'));
                die;
            }
        }
    }
    public function index()
    {
        helper('functions');
        $data = [
            'judul' => 'Transaksi',
            'data' => transaksi()
        ];
        return view('transaksi', $data);
    }

    public function add()
    {
        helper('functions');
        $no_nota = no_nota();
        $id = $this->request->getVar('id');
        $inventaris = $this->request->getVar('inventaris');

        foreach ($id as $i) {
            $keranjang = \App\Models\Keranjangs::class;
            $keranjang = new $keranjang;
            $k = $keranjang->where('id', $i)->first();

            $produk = \App\Models\Produks::class;
            $produk = new $produk;
            $p = $produk->where('id', $k['produk_id'])->first();

            $data['username'] = session('username');
            $data['no_nota'] = $no_nota;
            $data['tgl'] = now();
            $data['penerima_order'] = (session('role') == 'User' ? '' : session('username'));;
            $data['pj_order'] = (session('role') == 'User' ? '' : session('username'));;
            $data['produk'] = $p['produk'];
            $data['harga'] = $p['harga_jual'];
            $data['qty'] = $k['quantity_keranjang'];
            $data['jumlah'] = $p['harga_jual'] * $k['quantity_keranjang'];
            $data['catatan'] = $k['catatan_keranjang'];
            $data['progres'] = ($inventaris == 'on' ? 'Selesai' : 'Menunggu');
            $data['uang_modal'] = $p['harga_beli'] * $k['quantity_keranjang'];
            $data['tgl_uangkeluar'] = '';
            $data['uang_keluar'] = ($inventaris == 'on' ? $p['harga_beli'] : 0);
            $data['ket_uangkeluar'] = '';
            $data['pj_uangkeluar'] = (session('role') == 'User' ? '' : session('username'));;
            $data['nota_uangkeluar'] = 'nota.jpg';
            $data['tgl_uangmasuk'] = '';
            $data['uang_masuk'] = 0;
            $data['penerima_uangmasuk'] = (session('role') == 'User' ? '' : session('username'));;
            $data['ket_uangmasuk'] = '';
            $data['tgl_diterimabendahara'] = '';
            $data['ket'] = ($inventaris == 'on' ? 'Inv' : 'Transaksi');

            $transaksi = \App\Models\Transaksis::class;
            $transaksi = new $transaksi;

            if ($transaksi->save($data)) {
                $keranjang->delete($i);
                if ($inventaris == 'on') {
                    $datainv = [
                        'tgl' => now(),
                        'petugas' => session('nama'),
                        'no_inv' => no_inv(),
                        'barang' => $p['produk'],
                        'harga' => $p['harga_beli'],
                        'qty' => $k['quantity_keranjang'],
                        'jumlah' => $p['harga_beli'] * $k['quantity_keranjang'],
                        'toko' => $p['link_pembelian'],
                        'tempat' => '',
                        'kondisi' => 'Baik',
                        'catatan' => $k['catatan_keranjang']
                    ];
                    $inv = \App\Models\Invs::class;
                    $inv = new $inv;

                    $inv->save($datainv);
                }
            }
        }
        $ord = ucfirst(session('nama')) . ' melakukan transaksi baru.';
        if ($inventaris == 'on') {
            $ord = ucfirst(session('nama')) . ' membeli inventaris baru.';
        }
        $data = [
            'tgl' => now(),
            'subjek' => strtoupper(session('nama')),
            'objek' => '',
            'order' => $ord,
            'tabel' => 'transaksi',
            'target_id' => str_replace("/", "-", $no_nota),
            'read' => ''
        ];

        if (addnotif($data)) {
            echo json_encode(['status' => '200']);
        }

        die;
    }

    public function detail($nota)
    {
        $nota = str_replace("-", "/", $nota);

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('no_nota', $nota)->orderBy('produk', 'ASC')->find();

        $data = [
            'judul' => "Transaksi",
            'nota' => $nota,
            'data' => $q
        ];
        return view('detailtransaksi', $data);
    }

    public function caritransaksi()
    {
        helper('functions');
        $q = caritransaksi($this->request->getVar('val'));

        $res = [
            'status' => '200',
            'data' => $q
        ];
        echo json_encode($res);
        die;
    }

    public function search($search)
    {
        helper('functions');

        $data = [
            'judul' => 'Transaksi',
            'val' => $search,
            'data' => searchtransaksi($search)
        ];
        return view('transaksi', $data);
    }
    public function page($page)
    {
        helper('functions');

        $data = [
            'judul' => 'Transaksi',
            'data' => pagination('transaksi', $page)
        ];
        return view('pagetransaksi', $data);
    }

    public function nota($nota)
    {
        $nota = str_replace("-", "/", $nota);

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('no_nota', $nota)->orderBy('produk', 'ASC')->find();
        // dd($q);
        $logo = '<img width="60" src="logo/djana.png"/>';
        $data = [
            'judul' => $nota,
            'logo' => $logo,
            'data' => $q
        ];


        $set = [
            'mode' => 'utf-8',
            'format' => [210, 110],
            'orientation' => 'P',
            'margin_left' => 7,
            'margin_right' => 7,
            'margin_top' => 6,
            'margin_bottom' => 6
        ];

        $mpdf = new \Mpdf\Mpdf($set);

        $html = view('nota', $data);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Nota djana' . $nota . '.pdf', 'I');
    }

    public function tunjukpj($nota)
    {
        $nota = str_replace("-", "/", $nota);
        $con = \App\Models\Configs::class;
        $con = new $con;
        $data = [
            'judul' => 'Transaksi',
            'data' => $con->djana(),
            'nota' => $nota
        ];
        return view('tunjukpjtransaksi', $data);
    }


    public function savetunjukpj()
    {


        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $user = \App\Models\Users::class;
        $user = new $user;



        $no_nota = $this->request->getVar('no_nota');
        $pj_order = $this->request->getVar('pj_order');

        $pj = $user->where('username', $pj_order)->first();

        $q = $transaksi->where('no_nota', $no_nota)->orderBy('produk', 'ASC')->find();

        foreach ($q as $i) {
            $i['penerima_order'] = session('nama');
            $i['pj_order'] = $pj_order;
            $i['pj_uangkeluar'] = $pj_order;
            $i['penerima_uangmasuk'] = $pj_order;

            if ($transaksi->save($i)) {
                $ntf = \App\Models\Notifs::class;
                $ntf = new $ntf;

                $data['tgl'] = now();
                $data['subjek'] = strtoupper($pj['nama']);
                $data['objek'] = '';
                $data['order'] = ucfirst($pj['nama']) . ' mendapat tugas baru dari ' . session('nama') . '.';
                $data['tabel'] = 'tugas';
                $data['target_id'] = $i['id'];
                $data['read'] = '';

                $ntf->save($data);
            }
        }

        session()->setFlashdata('sukses', 'Artikel berhasil diupdate!');
        return redirect()->to(base_url('transaksi'));
    }
}

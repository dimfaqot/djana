<?php

namespace App\Controllers;

class Pengeluaran extends BaseController
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
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $where = ['Service', 'Donasi', 'Pembayaran'];
        $q = $transaksi->whereIn('ket', $where)->orderBy('tgl', 'DESC')->find();

        $val = [];

        foreach ($q as $i) {
            $exp = explode(" ", $i['tgl']);
            $i['tgl'] = $exp[0];
            $val[] = $i;
        }

        $data = [
            'judul' => "Pengeluaran",
            'data' => $val
        ];
        return view('pengeluaran', $data);
    }

    public function add()
    {
        $data = [
            'judul' => "Pengeluaran",
            'jenis' => ['Service', 'Donasi', 'Pembayaran']
        ];
        return view('addpengeluaran', $data);
    }
    public function edit()
    {
        $id = $this->request->getVar('id');

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('id', $id)->first();

        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. Data tidak ditemukan.');
            return redirect()->to(base_url('pengeluaran'));
        }

        $data = [
            'judul' => "Pengeluaran",
            'jenis' => ['Service', 'Donasi', 'Pembayaran'],
            'data' => $q
        ];
        return view('editpengeluaran', $data);
    }

    public function save()
    {

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $ket = $this->request->getVar('ket');
        $produk = $this->request->getVar('produk');
        $uang_keluar = $this->request->getVar('uang_keluar');
        $ket_uangkeluar = $this->request->getVar('ket_uangkeluar');
        $catatan = $this->request->getVar('catatan');
        $gambar = $this->request->getFile('nota_uangkeluar');

        $randomname = 'nota.jpg';

        if ($gambar->getError() == 0) {
            $randomname = $gambar->getRandomName();

            $size = (int)str_replace(".", "", $gambar->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('pengeluaran/add'));
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $gambar->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('pengeluaran/add'));
            }

            $gambar->move('nota/', $randomname);
        }


        $data['username'] = session('username');
        $data['no_nota'] = '';
        $data['tgl'] = now();
        $data['penerima_order'] = (session('role') == 'User' ? '' : session('username'));
        $data['pj_order'] = (session('role') == 'User' ? '' : session('username'));
        $data['produk'] = $produk;
        $data['harga'] = 0;
        $data['qty'] = 0;
        $data['jumlah'] = 0;
        $data['catatan'] = $catatan;
        $data['progres'] = 'Proses';
        $data['uang_modal'] = 0;
        $data['tgl_uangkeluar'] = now();
        $data['uang_keluar'] = $uang_keluar;
        $data['ket_uangkeluar'] = $ket_uangkeluar;
        $data['pj_uangkeluar'] = (session('role') == 'User' ? '' : session('username'));
        $data['nota_uangkeluar'] = $randomname;
        $data['tgl_uangmasuk'] = '';
        $data['uang_masuk'] = 0;
        $data['penerima_uangmasuk'] = '';
        $data['ket_uangmasuk'] = '';
        $data['tgl_diterimabendahara'] = '';
        $data['ket'] = $ket;

        if ($transaksi->save($data)) {
            $target = $transaksi->insertID();
            $ntf = \App\Models\Notifs::class;
            $ntf = new $ntf;

            $notif = [
                'tgl' => now(),
                'subjek' => strtoupper(session('nama')),
                'objek' => '',
                'order' => session('nama') . ' membuat pengeluaran baru (' . $ket . ').',
                'tabel' => 'pengeluaran',
                'target_id' => $target,
                'read' => ''
            ];

            if ($ntf->save($notif)) {
                session()->setFlashdata('sukses', 'khj');
                return redirect()->to(base_url('pengeluaran'));
            }
        }
    }
    public function update()
    {
        $id = $this->request->getVar('id');

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('id', $id)->first();

        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. Data tidak ditemukan.');
            return redirect()->to(base_url('pengeluaran'));
        }


        $ket = $this->request->getVar('ket');
        $produk = $this->request->getVar('produk');
        $uang_keluar = $this->request->getVar('uang_keluar');
        $ket_uangkeluar = $this->request->getVar('ket_uangkeluar');
        $catatan = $this->request->getVar('catatan');
        $gambar = $this->request->getFile('nota_uangkeluar');

        $randomname = $q['nota_uangkeluar'];

        if ($gambar->getError() == 0) {
            $randomname = $gambar->getRandomName();

            $size = (int)str_replace(".", "", $gambar->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('pengeluaran/add'));
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $gambar->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('pengeluaran/add'));
            }

            $gambar->move('nota/', $randomname);

            if ($q['nota_uangkeluar'] !== 'nota.jpg') {
                unlink('nota/' . $q['nota_uangkeluar']);
            }
        }

        $tgl = $q['tgl'];
        $pj_order = $q['pj_order'];
        $tgluangkeluar = $q['tgl_uangkeluar'];
        $pj_uangkeluar = $q['pj_uangkeluar'];

        if ($produk !== $q['produk']) {
            $tgl = now();
            $pj_order = (session('role') == 'User' ? '' : session('username'));
            $tgluangkeluar = now();
            $pj_uangkeluar = (session('role') == 'User' ? '' : session('username'));
        }

        if ($uang_keluar !== $q['uang_keluar']) {
            $tgluangkeluar = now();
            $pj_uangkeluar = (session('role') == 'User' ? '' : session('username'));
        }



        $q['tgl'] = $tgl;
        $q['ket'] = $ket;
        $q['produk'] = $produk;
        $q['uang_keluar'] = $uang_keluar;
        $q['tgl_uangkeluar'] = $tgluangkeluar;
        $q['pj_uangkeluar'] = $pj_uangkeluar;
        $q['ket_uangkeluar'] = $ket_uangkeluar;
        $q['catatan'] = $catatan;
        $q['pj_order'] = $pj_order;
        $q['nota_uangkeluar'] = $randomname;


        if ($transaksi->save($q)) {

            $ntf = \App\Models\Notifs::class;
            $ntf = new $ntf;

            $target = $ntf->where('tabel', 'pengeluaran')->where('target_id', $id)->first();
            if ($target) {
                $target['subjek'] = strtoupper(session('nama'));
                $target['order'] = session('nama') . ' mengubah data pengeluaran (' . $ket . ').';
                $target['read'] = '';

                if ($ntf->save($target)) {
                    session()->setFlashdata('sukses', 'khj');
                    return redirect()->to(base_url('pengeluaran'));
                }
            }
        }
    }
    public function detail($id)
    {

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('id', $id)->first();

        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. Data tidak ditemukan.');
            return redirect()->to(base_url('pengeluaran'));
        }

        $data = [
            'judul' => "Pengeluaran",
            'data' => $q
        ];
        return view('detailpengeluaran', $data);
    }
}

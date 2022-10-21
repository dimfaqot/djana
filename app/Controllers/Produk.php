<?php

namespace App\Controllers;

class Produk extends BaseController
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
        helper('functions');
        $data = [
            'judul' => 'Produk',
            'val' => '',
            'data' => produk()
        ];
        return view('produk', $data);
    }
    public function search($search)
    {
        helper('functions');

        $res = search($search);

        $data = [
            'judul' => 'Produk',
            'val' => $search,
            'data' => ['jenis' => $res['jenis'], 'produk' => $res['produk']]
        ];
        return view('produk', $data);
    }
    public function detail($id)
    {

        helper('functions');
        $produk = produk($id);

        $data = [
            'judul' => 'Produk',
            'data' => $produk,
            'produk' => produk()
        ];
        return view('detailproduk', $data);
    }

    public function cariproduk()
    {
        helper('functions');
        $q = cariproduk($this->request->getVar('val'));

        $res = [
            'status' => '200',
            'data' => $q
        ];
        echo json_encode($res);
        die;
    }

    public function add()
    {
        if (session('role') == 'User' || session('role') == 'Guest') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }

        $mod = \App\Models\Configs::class;
        $mod = new $mod;

        $data = [
            'judul' => 'Produk',
            'jenis' => $mod->jenis()
        ];

        return view('addproduk', $data);
    }

    public function save()
    {
        if (session('role') == 'User' || session('role') == 'Guest') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }

        helper('functions');
        $jenis = $this->request->getVar('jenis');
        $produk = $this->request->getVar('produk');
        $harga_beli = $this->request->getVar('harga_beli');
        $harga_jual = $this->request->getVar('harga_jual');
        $link_pembelian = $this->request->getVar('link_pembelian');
        $detail_produk = $this->request->getVar('detail_produk');
        $gambar = $this->request->getFile('gambar');

        $randomname = 'produk.jpg';

        if ($gambar->getError() == 0) {
            $randomname = $gambar->getRandomName();

            $size = (int)str_replace(".", "", $gambar->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('produk/add'));
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $gambar->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('produk/add'));
            }

            $gambar->move('images/', $randomname);
        }

        $data = [
            'petugas_produk' => session('nama'),
            'jenis' => $jenis,
            'produk' => $produk,
            'gambar' => $randomname,
            'harga_beli' => $harga_beli,
            'harga_beli_sebelumnya' => 0,
            'harga_jual' => $harga_jual,
            'harga_jual_sebelumnya' => 0,
            'link_pembelian' => $link_pembelian,
            'detail_produk' => $detail_produk,
            'created_produk' => now(),
            'updated_produk' => now()
        ];
        // dd($data);
        $mod = \App\Models\Produks::class;
        $mod = new $mod;
        $mod->save($data);
        $id = $mod->getInsertID();

        if ($id) {
            $ntf = \App\Models\Notifs::class;
            $ntf = new $ntf;
            $data = [
                'tgl' => now(),
                'subjek' => strtoupper(session('nama')),
                'objek' => '',
                'order' => ucfirst(session('nama')) . ' menambahkan produk baru.',
                'tabel' => 'produk',
                'target_id' => $id,
                'read' => ''
            ];

            if ($ntf->save($data)) {
                session()->setFlashdata('sukses', 'Sukses');
                return redirect()->to(base_url('produk/add'));
            }
        }
    }
    public function edit()
    {
        $id = $this->request->getVar('id');
        $mod = \App\Models\Produks::class;
        $mod = new $mod;

        $con = \App\Models\Configs::class;
        $con = new $con;

        $q = $mod->where('id', $id)->first();
        if (!$q) {
            return redirect()->to(base_url('produk'));
        }

        $data = [
            'judul' => 'Produk',
            'data' => $q,
            'order' => 'Edit',
            'jenis' => $con->jenis()
        ];
        return view('editproduk', $data);
    }
    public function copy()
    {
        $id = $this->request->getVar('id');
        $mod = \App\Models\Produks::class;
        $mod = new $mod;

        $con = \App\Models\Configs::class;
        $con = new $con;

        $q = $mod->where('id', $id)->first();
        if (!$q) {
            return redirect()->to(base_url('produk'));
        }

        $data = [
            'judul' => 'Produk',
            'order' => 'Copy',
            'data' => $q,
            'jenis' => $con->jenis()
        ];
        return view('editproduk', $data);
    }

    public function update()
    {
        if (session('role') == 'User' || session('role') == 'Guest') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }

        helper('functions');
        $id = $this->request->getVar('id');
        $mod = \App\Models\Produks::class;
        $mod = new $mod;
        $q = $mod->where('id', $id)->first();
        if (!$q) {
            return redirect()->to(base_url('produk'));
        }


        $jenis = $this->request->getVar('jenis');
        $produk = $this->request->getVar('produk');
        $harga_beli = $this->request->getVar('harga_beli');
        $harga_jual = $this->request->getVar('harga_jual');
        $link_pembelian = $this->request->getVar('link_pembelian');
        $detail_produk = $this->request->getVar('detail_produk');

        $q['jenis'] = $jenis;
        $q['produk'] = $produk;
        $q['link_pembelian'] = $link_pembelian;
        $q['detail_produk'] = $detail_produk;
        $q['petugas_produk'] = session('nama');
        $q['updated_produk'] = now();

        if ($q['harga_beli'] !== $harga_beli) {
            $q['harga_beli_sebelum'] = $q['harga_beli'];
        }
        if ($q['harga_jual'] !== $harga_jual) {
            $q['harga_jual_sebelum'] = $q['harga_jual'];
        }
        $q['harga_beli'] = $harga_beli;
        $q['harga_jual'] = $harga_jual;
        $gambar = $this->request->getFile('gambar');


        if ($gambar->getError() == 0) {
            $randomname = $gambar->getRandomName();

            $size = (int)str_replace(".", "", $gambar->getSizeByUnit('mb'));

            if ($size > 2000) {
                session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                return redirect()->to(base_url('produk/add'));
            }

            $ext = ['jpg', 'jpeg', 'png'];
            $exp = explode(".", $gambar->getName());
            $exe = strtolower(end($exp));
            if (array_search($exe, $ext) === false) {
                session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                return redirect()->to(base_url('produk/add'));
            }

            $gambar->move('images/', $randomname);

            if ($q['gambar'] !== 'produk.jpg') {
                unlink('images/' . $q['gambar']);
            }
            $q['gambar'] = $randomname;
        }

        if ($mod->save($q)) {
            $ntf = \App\Models\Notifs::class;
            $ntf = new $ntf;
            $data = [
                'tgl' => now(),
                'subjek' => strtoupper(session('nama')),
                'objek' => '',
                'order' => ucfirst(session('nama')) . ' mengubah data produk.',
                'tabel' => 'produk',
                'target_id' => $id,
                'read' => ''
            ];

            if ($ntf->save($data)) {
                session()->setFlashdata('sukses', 'Sukses');
                return redirect()->to(base_url('produk'));
            }
        }
    }
}

<?php

namespace App\Controllers;

class Peminjaman extends BaseController
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
        $mod = \App\Models\Peminjamans::class;
        $mod = new $mod;

        $data = [
            'judul' => 'Peminjaman',
            'data' => $mod->orderBy('tgl', 'DESC')->findAll()
        ];
        return view('peminjaman', $data);
    }
    public function add()
    {
        $mod = \App\Models\Invs::class;
        $mod = new $mod;
        $con = \App\Models\Configs::class;
        $con = new $con;
        $data = [
            'judul' => 'Peminjaman',
            'data' => $mod->orderBy('barang', 'ASC')->findAll(),
            'djana' => $con->djana()
        ];
        return view('addpeminjaman', $data);
    }

    public function save()
    {
        helper('functions');
        $mod = \App\Models\Invs::class;
        $mod = new $mod;
        $barang = $this->request->getVar('barang');
        $q = $mod->where('id', $barang)->first();

        $petugas = $this->request->getVar('petugas');
        $jml = $this->request->getVar('jml');
        $kondisi = $this->request->getVar('kondisi');
        $catatan = $this->request->getVar('catatan');

        $user = \App\Models\Users::class;
        $user = new $user;

        $u = $user->where('username', $petugas)->first();

        if ($q) {

            $data = [
                'id_peminjam' => session('id'),
                'peminjam' => session('nama'),
                'petugas' => $u['nama'],
                'tgl' => now(),
                'no_inv' => $q['no_inv'],
                'barang_id' => $barang,
                'barang' => $q['barang'],
                'jml' => $jml,
                'biaya' => 0,
                'penerima_uang' => '',
                'tgl_dikembalikan' => '',
                'kondisi' => $kondisi,
                'catatan' => 'Dipinjam sampai ' . $catatan,
                'ket' => 'Dipinjam'
            ];

            $db = \App\Models\Peminjamans::class;
            $db = new $db;
            if ($db->save($data)) {
                $idpeminjaman = $db->insertID();
                $q['kondisi'] = 'Dipinjam';

                if ($mod->save($q)) {
                    $notif = [
                        'tgl' => now(),
                        'subjek' => strtoupper($u['nama']),
                        'objek' => '',
                        'order' => session('nama') . ' meminjam barang kepada ' . $u['nama'],
                        'tabel' => 'peminjaman',
                        'target_id' => $idpeminjaman,
                        'read' => ''
                    ];
                    $notf = \App\Models\Notifs::class;
                    $notf = new $notf;

                    if ($notf->save($notif)) {
                        session()->setFlashdata('sukses', 'Sukses');
                        return redirect()->to(base_url('peminjaman'));
                    }
                }
            }
        }
    }
    public function edit($id)
    {
        helper('functions');
        $mod = \App\Models\Peminjamans::class;
        $mod = new $mod;
        $q = $mod->where('id', $id)->first();


        $con = \App\Models\Configs::class;
        $con = new $con;
        if ($q) {
            $data = [
                'judul' => 'Peminjaman',
                'data' => $q,
                'djana' => $con->djana()
            ];
            return view('editpeminjaman', $data);
        }
    }
    public function update()
    {
        helper('functions');
        $mod = \App\Models\Peminjamans::class;
        $mod = new $mod;
        $id = $this->request->getVar('id');


        $q = $mod->where('id', $id)->first();

        $penerima_uang = $this->request->getVar('penerima_uang');
        $biaya = $this->request->getVar('biaya');
        $kondisi = $this->request->getVar('kondisi');

        $user = \App\Models\Users::class;
        $user = new $user;

        $u = $user->where('username', $penerima_uang)->first();
        if ($q) {
            $q['biaya'] = $biaya;
            $q['penerima_uang'] = $u['nama'];
            $q['kondisi'] = $kondisi;
            $q['tgl_dikembalikan'] = now();
            $q['ket'] = 'Selesai';

            if ($mod->save($q)) {
                $idinv = $q['barang_id'];

                $db = \App\Models\Invs::class;
                $db = new $db;

                $inv = $db->where('id', $idinv)->first();

                $inv['kondisi'] = $kondisi;

                if ($db->save($inv)) {

                    if ($biaya > 0) {

                        $transaksi = [
                            'tgl' => now(),
                            'username' => $penerima_uang,
                            'no_nota' =>  no_nota(),
                            'penerima_order' => $u['nama'],
                            'pj_order' => $penerima_uang,
                            'produk' => $q['barang'],
                            'harga' => 0,
                            'qty' => $q['jml'],
                            'jumlah' => 0,
                            'catatan' => $q['catatan'],
                            'progres' => 'Pembayaran',
                            'uang_modal' => 0,
                            'tgl_uangkeluar' => '',
                            'uang_keluar' => 0,
                            'ket_uangkeluar' => '',
                            'pj_uangkeluar' => '',
                            'nota_uangkeluar' => 'nota.jpg',
                            'tgl_uangmasuk' => now(),
                            'uang_masuk' => $biaya,
                            'penerima_uangmasuk' => $penerima_uang,
                            'ket_uangmasuk' => 'Sewa/peminjaman alat',
                            'tgl_diterimabendahara' => '',
                            'ket' => 'Persewaan'
                        ];

                        $trans = \App\Models\Transaksis::class;
                        $trans = new $trans;

                        if ($trans->save($transaksi)) {

                            $notif = [
                                'tgl' => now(),
                                'subjek' => strtoupper($u['nama']),
                                'objek' => '',
                                'order' => $u['nama'] . ' menerima uang sewa dari ' . session('nama'),
                                'tabel' => 'peminjaman',
                                'target_id' => $id,
                                'read' => ''
                            ];
                            $notf = \App\Models\Notifs::class;
                            $notf = new $notf;

                            if ($notf->save($notif)) {
                                session()->setFlashdata('sukses', 'Sukses');
                                return redirect()->to(base_url('peminjaman'));
                            }
                        }
                    }


                    $notif = [
                        'tgl' => now(),
                        'subjek' => strtoupper($u['nama']),
                        'objek' => '',
                        'order' => session('nama') . ' mengembalikan barang kepada ' . $u['nama'],
                        'tabel' => 'peminjaman',
                        'target_id' => $id,
                        'read' => ''
                    ];
                    $notf = \App\Models\Notifs::class;
                    $notf = new $notf;

                    if ($notf->save($notif)) {
                        session()->setFlashdata('sukses', 'Sukses');
                        return redirect()->to(base_url('peminjaman'));
                    }
                }
            }
        }
    }

    public function detail($id)
    {
        helper('functions');
        $mod = \App\Models\Peminjamans::class;
        $mod = new $mod;
        $q = $mod->where('id', $id)->first();

        if ($q) {
            $data = [
                'judul' => 'Peminjaman',
                'data' => $q
            ];
            return view('detailpeminjaman', $data);
        }
    }
}

<?php

namespace App\Controllers;

class Tugas extends BaseController
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
            'judul' => 'Tugas',
            'val' => '',
            'data' => tugas()
        ];
        return view('tugas', $data);
    }

    public function page($page)
    {
        helper('functions');

        $data = [
            'judul' => 'Tugas',
            'data' => paginationtugas($page)
        ];
        return view('pagetugas', $data);
    }

    public function caritugas()
    {
        helper('functions');
        $q = caritugas($this->request->getVar('val'));

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
            'judul' => 'Tugas',
            'val' => $search,
            'data' => searchtugas($search)
        ];
        return view('tugas', $data);
    }

    public function detail($id)
    {
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;

        $q = $transaksi->where('id', $id)->first();

        if ($q) {
            if (session('role') !== 'Root' && session('role') !== 'Bendahara') {
                if ($q['username'] !== session('username') && $q['pj_order'] !== session('username') && $q['pj_uangkeluar'] !== session('username') && $q['penerima_uangmasuk'] !== session('username') && $q['username'] !== session('username')) {
                    // dd('Ok');
                    $data = [
                        'judul' => "Tugas",
                        'val' => false,
                        'data' => $q
                    ];

                    return view('detailtugas', $data);
                }
            }
        }


        $data = [
            'judul' => "Tugas",
            'val' => $q,
            'data' => $q
        ];

        return view('detailtugas', $data);
    }

    public function edit()
    {

        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;
        $id = $this->request->getVar('id');

        $q = $transaksi->where('id', $id)->first();

        $notif = [];
        if ($q) {
            $pj_order = $this->request->getVar('pj_order');
            $progres = $this->request->getVar('progres');
            $uang_keluar = $this->request->getVar('uang_keluar');
            $pj_uangkeluar = $this->request->getVar('pj_uangkeluar');
            $ket_uangkeluar = $this->request->getVar('ket_uangkeluar');
            $uang_masuk = $this->request->getVar('uang_masuk');
            $ket_uangmasuk = $this->request->getVar('ket_uangmasuk');

            $nota = $this->request->getFile('nota_uangkeluar');

            if ($nota !== null) {
                if ($nota->getError() == 0) {
                    $randomname = $nota->getRandomName();

                    $size = (int)str_replace(".", "", $nota->getSizeByUnit('mb'));

                    if ($size > 2000) {
                        session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
                        return redirect()->to(base_url('tugas/detail/') . '/' . $id);
                    }

                    $ext = ['jpg', 'jpeg', 'png'];
                    $exp = explode(".", $nota->getName());
                    $exe = strtolower(end($exp));
                    if (array_search($exe, $ext) === false) {
                        session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
                        return redirect()->to(base_url('tugas/detail/') . '/' . $id);
                    }

                    $nota->move('nota/', $randomname);

                    if ($q['nota_uangkeluar'] !== 'nota.jpg') {
                        unlink('nota/' . $q['nota_uangkeluar']);
                    }
                    $q['nota_uangkeluar'] = $randomname;

                    $notif[] = 'nota_uangkeluar';
                }
            }

            if ($pj_order !== null) {
                if ($q['pj_order'] !== $pj_order) {
                    $q['pj_order'] = $pj_order;
                    $notif[] = 'pj_order';
                }
            }

            if ($progres !== null) {
                if ($q['progres'] !== $progres) {
                    $q['progres'] = $progres;
                    $notif[] = 'progres';
                }
            }

            if ($pj_uangkeluar !== null) {
                if ($q['pj_uangkeluar'] !== $pj_uangkeluar) {
                    $q['pj_uangkeluar'] = $pj_uangkeluar;
                    $notif[] = 'pj_uangkeluar';
                }
            }
            if ($pj_uangkeluar !== null) {
                if ($q['uang_keluar'] !== $uang_keluar) {
                    $q['uang_keluar'] = $uang_keluar;
                    $d = intval(date('d'));
                    $q['tgl_uangkeluar'] = $d . '-' . date('n-Y H:i:s');
                    $notif[] = 'uang_keluar';
                }
            }

            if ($ket_uangkeluar !== null) {
                if ($q['ket_uangkeluar'] !== $ket_uangkeluar) {
                    $q['ket_uangkeluar'] = $ket_uangkeluar;
                    $notif[] = 'ket_uangkeluar';
                }
            }

            if ($q['uang_masuk'] !== $uang_masuk) {
                $q['uang_masuk'] = $uang_masuk;
                $d = intval(date('d'));
                $q['tgl_uangmasuk'] = $d . '-' . date('n-Y H:i:s');
                $q['penerima_uangmasuk'] = session('username');
                $notif[] = 'uang_masuk';
            }


            if ($q['ket_uangmasuk'] !== $ket_uangmasuk) {
                $q['ket_uangmasuk'] = $ket_uangmasuk;
                $notif[] = 'ket_uangmasuk';
            }

            if ($transaksi->save($q)) {
                helper('functions');
                $ntf = \App\Models\Notifs::class;
                $ntf = new $ntf;

                $n = $ntf->where('tabel', 'tugas')->where('target_id', $id)->first();

                if ($n) {
                    if (in_array('pj_order', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper($pj_order);
                        $n['objek'] = '';
                        $n['order'] = ucfirst($pj_order) . ' mendapat tugas baru dari ' . session('nama') . '.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('progres', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper(session('nama'));
                        $n['objek'] = '';
                        $n['order'] = session('nama') . ' mengubah progres menjadi ' . $progres . '.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('ket_uangkeluar', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper(session('nama'));
                        $n['objek'] = '';
                        $n['order'] = ucfirst(session('nama')) . ' mengubah keterangan uang keluar.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('uang_keluar', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper(session('nama'));
                        $n['objek'] = '';
                        $n['order'] = ucfirst(session('nama')) . ' menubah uang keluar.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('pj_uangkeluar', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper($pj_uangkeluar);
                        $n['objek'] = '';
                        $n['order'] = ucfirst($pj_uangkeluar) . ' mendapat tugas menjadi pj uang keluar dari ' . session('nama') . '.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('ket_uangmasuk', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper(session('nama'));
                        $n['objek'] = '';
                        $n['order'] = ucfirst(session('nama')) . ' mengubah keterangan uang masuk.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }
                    if (in_array('uang_masuk', $notif)) {
                        $n['tgl'] = now();
                        $n['subjek'] = strtoupper(session('nama'));
                        $n['objek'] = '';
                        $n['order'] = ucfirst(session('nama')) . ' mengubah uang masuk.';
                        $n['tabel'] = 'tugas';
                        $n['target_id'] = $id;
                        $n['read'] = '';
                    }

                    $ntf->save($n);
                } else {
                    if (in_array('pj_order', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper($pj_order);
                        $data['objek'] = '';
                        $data['order'] = ucfirst($pj_order) . ' mendapat tugas baru dari ' . session('nama') . '.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('progres', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper(session('nama'));
                        $data['objek'] = '';
                        $data['order'] = session('nama') . ' mengubah progres menjadi ' . $progres . '.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('ket_uangkeluar', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper(session('nama'));
                        $data['objek'] = '';
                        $data['order'] = ucfirst(session('nama')) . ' mengubah keterangan uang keluar.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('uang_keluar', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper(session('nama'));
                        $data['objek'] = '';
                        $data['order'] = ucfirst(session('nama')) . ' menubah uang keluar.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('pj_uangkeluar', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper($pj_uangkeluar);
                        $data['objek'] = '';
                        $data['order'] = ucfirst($pj_uangkeluar) . ' mendapat tugas menjadi pj uang keluar dari ' . session('nama') . '.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('ket_uangmasuk', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper(session('nama'));
                        $data['objek'] = '';
                        $data['order'] = ucfirst(session('nama')) . ' mengubah keterangan uang masuk.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }
                    if (in_array('uang_masuk', $notif)) {
                        $data['tgl'] = now();
                        $data['subjek'] = strtoupper(session('nama'));
                        $data['objek'] = '';
                        $data['order'] = ucfirst(session('nama')) . ' menubah uang masuk.';
                        $data['tabel'] = 'tugas';
                        $data['target_id'] = $id;
                        $data['read'] = '';
                    }

                    $ntf->save($data);
                }

                session()->setFlashdata('sukses', 'Artikel berhasil diupdate!');
                return redirect()->to(base_url('tugas/detail/') . '/' . $id);
            }
        }
    }

    public function selesai()
    {
        $transaksi = \App\Models\Transaksis::class;
        $transaksi = new $transaksi;
        $id = $this->request->getVar('id');

        $q = $transaksi->where('id', $id)->first();
        if ($q) {
            $q['progres'] = 'Selesai';
            $d = intval(date('d'));
            $q['tgl_diterimabendahara'] = $d . '-' . date('n-Y H:i:s');


            if ($transaksi->save($q)) {
                $ntf = \App\Models\Notifs::class;
                $ntf = new $ntf;

                $n = $ntf->where('tabel', 'tugas')->where('target_id', $id)->first();

                if ($n) {
                    helper('functions');
                    $n['tgl'] = now();
                    $n['subjek'] = strtoupper(session('nama'));
                    $n['objek'] = '';
                    $n['order'] = ucfirst(session('nama')) . ' memutuskan seluruh proses transaksi selesai.';
                    $n['tabel'] = 'tugas';
                    $n['target_id'] = $id;
                    $n['read'] = '';

                    $ntf->save($n);
                } else {
                    $data['tgl'] = now();
                    $data['subjek'] = strtoupper(session('nama'));
                    $data['objek'] = '';
                    $data['order'] = ucfirst(session('nama')) . ' memutuskan seluruh proses peminjaman selesai.';
                    $data['tabel'] = 'tugas';
                    $data['target_id'] = $id;
                    $data['read'] = '';
                    $ntf->save($data);
                }

                session()->setFlashdata('sukses', 'Artikel berhasil diupdate!');
                return redirect()->to(base_url('tugas/detail/') . '/' . $id);
            }
        }
    }
}

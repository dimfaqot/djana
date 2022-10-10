<?php

namespace App\Controllers;

class Keranjang extends BaseController
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
        $data = [
            'judul' => 'Keranjang'
        ];
        return view('keranjang', $data);
    }
    public function add()
    {
        $mod = \App\Models\Keranjangs::class;
        $mod = new $mod;

        $num = 1;
        $id = $this->request->getVar('id');
        $q = $mod->where('produk_id', $id)->first();
        if ($q) {
            $q['quantity_keranjang'] = $q['quantity_keranjang'] + $num;

            $mod->save($q);
        } else {
            $data = [
                'user_id' => session('id'),
                'produk_id' => $id,
                'quantity_keranjang' => 1,
                'catatan_keranjang' => ''
            ];

            $mod->save($data);
        }

        $data = [
            'judul' => 'Keranjang'
        ];
        return redirect()->to(base_url('keranjang'));
    }

    public function edit()
    {
        $mod = \App\Models\Keranjangs::class;
        $mod = new $mod;
        $id = $this->request->getVar('id');
        $q = $mod->where('id', $id)->first();

        $val = $this->request->getVar('val');
        $order = $this->request->getVar('order');

        if ($q) {
            if ($order == 'tambah' || $order == 'kurang' || $order == 'editkeranjang') {
                if ($val <= 0 || $val == "") {
                    $mod->delete($id);
                } else {
                    $q['quantity_keranjang'] = $val;
                    $mod->save($q);
                }
            } else  if ($order == 'pilih') {
                if ($q['pilih'] == 0) {
                    $q['pilih'] = 1;
                } else {
                    $q['pilih'] = 0;
                }
                $mod->save($q);
            } else {
                $q['catatan_keranjang'] = $val;
                $mod->save($q);
            }

            $res = [
                'status' => '200',
            ];
            echo json_encode($res);
        }
        die;
    }
}

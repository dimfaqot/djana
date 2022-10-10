<?php

namespace App\Controllers;

class Inventaris extends BaseController
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
        $inv = \App\Models\Invs::class;
        $inv = new $inv;
        $data = [
            'judul' => 'Inventaris',
            'data' => $inv->orderBy('tgl', 'DESC')->findAll()
        ];
        return view('inv', $data);
    }
    public function edit($id)
    {
        $inv = \App\Models\Invs::class;
        $inv = new $inv;
        $data = [
            'judul' => 'Inventaris',
            'data' => $inv->where('id', $id)->first()
        ];
        return view('editinv', $data);
    }
    public function update()
    {
        $inv = \App\Models\Invs::class;
        $inv = new $inv;

        $id = $this->request->getVar('id');
        $tempat = $this->request->getVar('tempat');
        $kondisi = $this->request->getVar('kondisi');
        $catatan = $this->request->getVar('catatan');
        $q = $inv->where('id', $id)->first();



        if ($q) {
            $q['tempat'] = $tempat;
            $q['kondisi'] = $kondisi;
            $q['catatan'] = $catatan;

            if ($inv->save($q)) {
                session()->setFlashdata('sukses', 'Sukses');
                return redirect()->to(base_url('inventaris'));
            }
        }
    }
}

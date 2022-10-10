<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        helper('functions');
        $data = [
            'judul' => 'Home | Djana',
            'val' => '',
            'data' => produk()
        ];
        return view('home', $data);
    }

    public function auth()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($username == "" || $password == "") {
            session()->setFlashdata('gagal', "Gagal!. Username dan password harus diisi!");
            return redirect()->to(base_url());
        }

        $user = \App\Models\Users::class;
        $user = new $user;

        // cek password sekarang
        $q = $user->where('username', $username)->first();
        if (!$q) {
            session()->setFlashdata('gagal', "Gagal!. Username tidak ditemukan!");
            return redirect()->to(base_url());
        } else {
            if (!password_verify($password, $q['password'])) {
                session()->setFlashdata('gagal', "Gagal!. Password salah!");
                return redirect()->to(base_url());
            } else {
                $r = $user->where('username', $username)->first();
                session()->set([
                    'id' => $q['id'],
                    'nama' => $q['nama'],
                    'username' => $q['username'],
                    'image' => $q['image'],
                    'alias' => $q['alias'],
                    'sub' => $q['sub'],
                    'role' => $r['role']
                ]);
                if ($r['role'] == 'User') {
                    return redirect()->to(base_url("produk"));
                } else {
                    return redirect()->to(base_url("dashboard"));
                }
            }
        }
    }

    public function search($search)
    {
        helper('functions');

        $res = search($search);


        $data = [
            'judul' => 'Cari Produk',
            'val' => $search,
            'data' => ['jenis' => $res['jenis'], 'produk' => $res['produk']]
        ];
        return view('home', $data);
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

    public function detailproduk($id)
    {
        helper('functions');
        $produk = produk($id);

        $data = [
            'judul' => $produk['produk'],
            'data' => $produk,
            'val' => $produk['jenis'],
            'produk' => produk()
        ];
        return view('homedetailproduk', $data);
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('nama');
        session()->remove('role');
        session()->remove('alias');
        session()->remove('image');

        return redirect()->to(base_url());
    }
}

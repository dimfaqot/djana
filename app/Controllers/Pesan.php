<?php

namespace App\Controllers;

class Pesan extends BaseController
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
            'judul' => 'Pesan'
        ];
        return view('pesan', $data);
    }
    public function detailpesan()
    {
        $data = [
            'judul' => 'Detail Pesan'
        ];
        return view('detailpesan', $data);
    }
}

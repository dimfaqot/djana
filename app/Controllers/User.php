<?php

namespace App\Controllers;

class User extends BaseController
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
        $mod = \App\Models\Users::class;
        $mod = new $mod;
        $con = \App\Models\Configs::class;
        $con = new $con;
        $data = [
            'judul' => 'User',
            'role' => $con->role(),
            'data' => $mod->where('id', session('id'))->first(),
            'search' => []
        ];
        return view('user', $data);
    }
    public function save()
    {
        $mod = \App\Models\Users::class;
        $mod = new $mod;

        $q = $mod->where('id', session('id'))->first();

        if ($q) {
            $nama = $this->request->getVar('nama');
            $alias = $this->request->getVar('alias');
            $password = $this->request->getVar('password');

            if ($q['nama'] !== $nama) {
                $q['nama'] = $nama;
            }
            if ($q['alias'] !== $alias) {
                $q['alias'] = $alias;
            }

            if ($password !== '') {
                $q['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if ($mod->save($q)) {
                session()->setFlashdata('sukses', 'Sukses');
                return redirect()->to(base_url('user'));
            }
        }
    }
    public function add()
    {
        $mod = \App\Models\Users::class;
        $mod = new $mod;

        $username = $this->request->getVar('username');
        $nama = $this->request->getVar('nama');
        $alias = $this->request->getVar('alias');
        $sub = $this->request->getVar('sub');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('role');

        if ($role === null) {
            $role = 'User';
        }

        $q = $mod->where('username', $username)->first();

        if ($q) {
            session()->setFlashdata('gagal', 'Username sudah terdaftar, silahkan cari yang lain.');
            return redirect()->to(base_url('user'));
        }

        $data = [
            'username' => $username,
            'nama' => $nama,
            'alias' => $alias,
            'sub' => $sub,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'image' => 'profile.jpg',
            'role' => $role
        ];

        if ($mod->save($data)) {
            session()->setFlashdata('gagal', 'Sukses!. Password user adalah ' . $password);
            return redirect()->to(base_url('user'));
        }
    }

    public function cariuser()
    {

        if (session('role') !== 'Root') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }
        $val = $this->request->getVar('val');
        $mod = \App\Models\Users::class;
        $mod = new $mod;

        $res = [
            'status' => '200',
            'data' => $mod->like('nama', $val, 'both')->orderBy('nama', 'Asc')->limit(4)->find()
        ];
        echo json_encode($res);
        die;
    }
    public function search()
    {
        if (session('role') !== 'Root') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }

        $mod = \App\Models\Users::class;
        $mod = new $mod;

        $id = $this->request->getVar('id');

        $con = \App\Models\Configs::class;
        $con = new $con;

        $data = [
            'judul' => 'User',
            'role' => $con->role(),
            'data' => $mod->where('id', session('id'))->first(),
            'search' => $mod->where('id', $id)->first()
        ];


        return view('user', $data);
    }
    public function edituser()
    {
        if (session('role') !== 'Root') {
            session()->setFlashdata('gagal', 'Hak akses ditolak!.');
            header("Location: " . base_url('dashboard'));
            die;
        }
        $mod = \App\Models\Users::class;
        $mod = new $mod;

        $id = $this->request->getVar('id');
        $q = $mod->where('id', $id)->first();

        if ($q) {
            $username = $this->request->getVar('username');
            $nama = $this->request->getVar('nama');
            $alias = $this->request->getVar('alias');
            $sub = $this->request->getVar('sub');
            $password = $this->request->getVar('password');
            $role = $this->request->getVar('role');

            if ($q['username'] !== $username) {
                $qusername = $mod->where('username', $username)->first();

                if ($qusername) {
                    session()->setFlashdata('gagal', 'Username sudah terdaftar, silahkan cari yang lain.');
                    return redirect()->to(base_url('user'));
                }
            }

            $q['username'] = $username;
            $q['sub'] = $sub;
            $q['role'] = $role;

            if ($q['nama'] !== $nama) {
                $q['nama'] = $nama;
            }
            if ($q['alias'] !== $alias) {
                $q['alias'] = $alias;
            }

            if ($password !== '') {
                $q['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            if ($mod->save($q)) {
                session()->setFlashdata('sukses', 'Sukses');
                return redirect()->to(base_url('user'));
            }
        }
    }
}

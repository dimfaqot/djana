<?php

namespace App\Controllers;

class Notif extends BaseController
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
            'judul' => 'Notif',
            'data' => notif()
        ];
        return view('notif', $data);
    }

    public function detail($id)
    {

        $mod = \App\Models\Notifs::class;
        $mod = new $mod;

        $q = $mod->where('id', $id)->first();
        if ($q['read'] == '') {
            $q['read'] = session('id');
        } else {
            $exp = explode(",", $q['read']);
            if (!in_array(session('id'), $exp)) {
                if ($q['read'] == '') {
                    $q['read'] = session('id');
                } else {
                    $q['read'] = $q['read'] . ',' . session('id');
                }
            }
        }


        $mod->save($q);
        $url = base_url() . '/' . $q['tabel'] . '/detail/' . $q['target_id'];
        return redirect()->to($url);
    }
}

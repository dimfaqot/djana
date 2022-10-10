<?php

use CodeIgniter\Commands\Utilities\Publish;

function menu($menu = null)
{
    $mod = \App\Models\Menus::class;
    $mod = new $mod;

    if ($menu === null) {
        $q = $mod->findAll();
        $val = [];

        foreach ($q as $i) {
            $exp = explode(",", $i['role']);
            if (in_array(session('role'), $exp)) {
                $val[] = $i;
            }
        }

        return $val;
    } else {
        $q = $mod->where('menu', $menu)->first();
        $exp = explode(",", $q['role']);

        if (in_array(session('role'), $exp)) {
            return true;
        } else {
            return false;
        }
    }
}

function firstWordUpCase($text)
{
    $newText = ucwords(strtolower($text));
    return $newText;
}

function keranjang()
{
    $mod = \App\Models\Keranjangs::class;
    $mod = new $mod;

    $q = $mod->select('keranjang.id as id, alias, user_id,username,nama,alias,sub,image,role,pilih,jenis,produk,gambar,harga_beli,harga_jual,link_pembelian,detail_produk,created_produk,updated_produk,harga_beli_sebelum, harga_jual_sebelum, catatan_keranjang, quantity_keranjang')->join('user', 'user_id=user.id')->join('produk', 'produk_id=produk.id')->where('user_id', session('id'))->orderBy('keranjang.id', 'DESC')->find();

    return $q;
}

function produk($id = null)
{
    $mod = \App\Models\Produks::class;
    $mod = new $mod;

    $all = $mod->select('jenis')->groupBy('jenis')->findAll();

    $jenis = [];

    foreach ($all as $i) {
        $jenis[] = $i['jenis'];
    }


    $mod;
    if ($id == null) {
        $query = $mod->findAll();
        $q = ['jenis' => $jenis, 'produk' => $query];
    } else {
        $q = $mod->where('produk.id', $id)->first();
    }


    return $q;
}

function search($search)
{
    $mod = \App\Models\Produks::class;
    $mod = new $mod;

    $q = $mod->like('produk', $search, 'both')->orLike('jenis', $search, 'both')->orderBy('produk.id', 'DESC')->find();

    $jenis = [];

    foreach ($q as $i) {
        if (!in_array($i['jenis'], $jenis)) {
            $jenis[] = $i['jenis'];
        }
    }

    $res = [
        'jenis' => $jenis,
        'produk' => $q
    ];
    return $res;
}

function cariproduk($val)
{
    $mod = \App\Models\Produks::class;
    $mod = new $mod;


    $jenis = $mod->select('jenis as produk')->like('jenis', $val, 'both')->groupBy('jenis')->find();
    $q = $mod->select('produk')->like('produk', $val, 'both')->find();

    foreach ($jenis as $i) {
        $q[] = ['produk' => $i['produk']];
    }
    return $q;
}

function caritransaksi($val)
{
    $mod = \App\Models\Transaksis::class;
    $mod = new $mod;


    $penerima_order = $mod->select('penerima_order')->like('penerima_order', $val, 'both')->groupBy('penerima_order')->find();
    $q = $mod->select('produk')->groupBy('produk')->like('produk', $val, 'both')->find();

    foreach ($penerima_order as $i) {
        $q[] = ['produk' => $i['penerima_order']];
    }
    return $q;
}

function searchtransaksi($search)
{
    $mod = \App\Models\Transaksis::class;
    $mod = new $mod;

    $mod->groupBy('no_nota')->like('produk', $search, 'both')->orLike('penerima_order', $search, 'both')->orderBy('no_nota', 'DESC');

    if (session('role') == 'user') {
        return $mod->where('username', session('username'))->find();
    } else {
        $q = $mod->findAll();

        $res = [];

        foreach ($q as $i) {
            $jml = $mod->where('no_nota', $i['no_nota'])->find();
            $x = $jml[0];
            $x['jml_barang'] = count($jml);
            $res[] = $x;
        }

        return $res;
    }
}

function notif($order = null)
{
    $mod = \App\Models\Notifs::class;
    $mod = new $mod;
    if (session('role') == 'User') {
        $where = ['peminjaman', 'produk', 'transaksi'];
        $data = $mod->whereIn('tabel', $where)->orderBy('tgl', 'DESC')->find();
        $q = [];

        foreach ($data as $i) {
            $exp = explode(" ", $i['order']);

            $inv = false;
            foreach ($exp as $d) {
                if ($d == session('nama')) {
                    $inv = true;
                }
            }

            if ($inv) {
                $q[] = $i;
            }
        }
    } else {
        $q = $mod->orderBy('tgl', 'DESC')->findAll();
    }

    $notif = [];
    $unread = 0;

    foreach ($q as $i) {
        $exp = explode(",", $i['read']);

        $read = 0;

        if (in_array(session('id'), $exp)) {
            $read = 1;
        }

        if ($i['objek'] == '') {
            if ($read == 0) {
                $unread++;
            }
        } else {
            $expo = explode(",", $i['objek']);
            if (in_array(session('username'), $expo)) {
                if ($read == 0) {
                    $unread++;
                }
            }
        }

        $i['read'] = $read;

        if ($i['objek'] == '') {
            $notif[] = $i;
        } else {
            $expo = explode(",", $i['objek']);
            if (in_array(session('username'), $expo)) {
                $notif[] = $i;
            }
        }
    }

    if ($order === null) {
        return $notif;
    } else {
        return $unread;
    }
}

function addnotif($data)
{
    $db = \App\Models\Notifs::class;
    $db = new $db;
    $db->save($data);
    return true;
}

function no_nota()
{
    $keranjang = \App\Models\Transaksis::class;
    $keranjang = new $keranjang;

    $q = $keranjang->orderBy('id', 'DESC')->first();

    $d = intval(date('d'));
    $m = date('n');
    $y = date('y');
    $no_nota = $d . '/' . date('n/y') . '/1';

    if ($q) {
        if ($q['no_nota'] !== '') {
            $exp = explode("/", $q['no_nota']);

            if ($y == $exp[2] && $m == $exp[1] && $d == $exp[0]) {
                $no = end($exp) + 1;
                $no_nota = $exp[0] . '/' . $exp[1] . '/' . $exp[2] . '/' . $no;
            } else if ($y == $exp[2] && $m == $exp[1] && $d !== $exp[0]) {
                $no_nota = $d . '/' . $exp[1] . '/' . $exp[2] . '/1';
            } else if ($y == $exp[2] && $m !== $exp[1]) {
                $no_nota = '1/' . $m . '/' . $exp[2] . '/1';
            } else if ($y !== $exp[2]) {
                $no_nota = '1/1/' . $y . '/1';
            }
        }
    }
    return $no_nota;
}

function progres($text = null)
{
    if ($text == null) {
        $progres = [
            ['color' => 'bg-danger', 'icon' => '<i class="fa fa-spinner"></i>', 'text' => 'Menunggu'],
            ['color' => 'bg-warning', 'icon' => '<i class="fa fa-space-shuttle"></i>', 'text' => 'Proses'],
            ['color' => 'bg-info', 'icon' => '<i class="fa fa-money"></i>', 'text' => 'Pembayaran'],
            ['color' => 'bg-success', 'icon' => '<i class="fa fa-check-circle"></i>', 'text' => 'Selesai']
        ];
        return $progres;
    }
    if ($text == 'Menunggu') {
        $res = [
            'color' => 'bg-danger',
            'icon' => '<i class="fa fa-spinner"></i>'
        ];
    }
    if ($text == 'Proses') {
        $res = [
            'color' => 'bg-warning',
            'icon' => '<i class="fa fa-space-shuttle"></i>'
        ];
    }
    if ($text == 'Pembayaran') {
        $res = [
            'color' => 'bg-info',
            'icon' => '<i class="fa fa-money"></i>'
        ];
    }
    if ($text == 'Selesai') {
        $res = [
            'color' => 'bg-success',
            'icon' => '<i class="fa fa-check-circle"></i>'
        ];
    }
    return $res;
}

function transaksi()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;

    $cols;
    if (session('role') == 'User') {
        $q = $cols->where('username', session('username'))->groupBy('no_nota')->orderBy('tgl', 'DESC')->find();
        $res = [];
        foreach ($q as $key => $i) {
            if ($key < 7) {
                $jmlbarang = $cols->where('username', session('username'))->where('no_nota', $i['no_nota'])->find();
                $i['jml_barang'] = count($jmlbarang);
                $res[] = $i;
            }
        }
        return $res;
    } else {
        $q =  $cols->orderBy('tgl', 'DESC')->groupBy('no_nota')->findAll();
        $res = [];
        foreach ($q as $i) {
            $jmlbarang = $cols->where('no_nota', $i['no_nota'])->find();
            $i['jml_barang'] = count($jmlbarang);
            $res[] = $i;
        }

        $val = [];
        foreach ($res as $key => $i) {
            if ($key < 7) {
                $val[] = $i;
            }
        }
        return $val;
    }
}

function counttransaksi()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;

    $cols;
    if (session('role') == 'User') {
        $q = $cols->where('username', session('username'))->groupBy('no_nota')->orderBy('tgl', 'DESC')->find();

        $count = 0;
        foreach ($q as $i) {
            if ($i['progres'] !== 'Selesai') {
                $count++;
            }
        }

        return $count;
    } else {
        $q =  $cols->orderBy('tgl', 'DESC')->groupBy('no_nota')->findAll();

        $count = 0;
        foreach ($q as $i) {
            if ($i['progres'] !== 'Selesai') {
                $count++;
            }
        }
        return $count;
    }
}

function pagination($tabel, $page, $row = 7, $spage = 3)
{
    $db      = \Config\Database::connect();
    $db = $db->table($tabel);



    $start = ($page * $row) - $row;
    $end = $start + $row;



    // dd($showpage);
    $data = [];

    $totalpage = 0;
    $q = $db->groupBy('no_nota')->orderBy('tgl', 'DESC')->get()->getResultArray();
    $totalpage = ceil(count($q) / $row);
    foreach ($q as $key => $i) {
        if ($key >= $start && $key < $end) {
            $jmlbarang = $db->where('no_nota', $i['no_nota'])->get()->getResultArray();
            $i['jml_barang'] = count($jmlbarang);
            $data[] = $i;
        }
    }


    $showpage = [];

    if ($totalpage <= $spage && $page <= $spage) {
        for ($i = 0; $i < $spage; $i++) {
            $showpage[] = $i + 1;
        }
    } else {
        // $mod = $totalpage % $spage;
        // if ($mod == 0) {
        //     for ($i = $spage - 1; $i >= 0; $i--) {
        //         $showpage[] = $page - $i;
        //     }
        // }
        // if ($mod > 0) {
        //     for ($i = 0; $i < $mod; $i++) {
        //         $showpage[] = $page + $i;
        //     }
        // }

        if ($page % $spage == 1) {
            $showpage[] = $page;
            $showpage[] = $page + 1;
            $showpage[] = $page + 2;
        }
        if ($page % $spage == 2) {
            $showpage[] = $page - 1;
            $showpage[] = $page;
            $showpage[] = $page + 1;
        }
        if ($page % $spage == 0) {
            $showpage[] = $page - 2;
            $showpage[] = $page - 1;
            $showpage[] = $page;
        }
    }

    $res = [
        'page' => $page,
        'showpage' => $showpage,
        'last' => $totalpage,
        'data' => $data
    ];
    return $res;
}

function rupiah($uang)
{

    $len = str_split($uang);
    // dd($len);
    $res = [];


    $val = [];
    foreach (array_reverse($len) as $key => $i) {
        $x = $key + 1;
        // echo $x;
        // echo "<br>";

        // if ($i == 1) {
        //     echo $x;
        // }

        $val[] = $i;
        if ($x % 3 == 0) {
            $res[] = implode("", $val);
            $val = [];
        }
        if ($x == count($len)) {
            // dd($val);
            $res[] = implode("", $val);
        }
    }

    $val = implode(".", $res);
    $val = str_split($val);
    $val = array_reverse($val);
    $val = implode("", $val);
    if (substr($val, 0, 1) == '.') {
        $val = ltrim($val, '.');
    }
    return $val;
}

function tugas()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;

    $val = [];
    $q = $cols->orderBy('tgl', 'DESC')->findAll();
    if (session('role') == 'Bendahara' || session('role') == 'Root') {
        foreach ($q as $key => $i) {
            if ($key < 7) {
                $i['msg'] = session('role');
                $val[] = $i;
            }
        }

        return $val;
    }


    $res = [];



    foreach ($q as $key => $i) {

        if ($i['pj_order'] == session('username')) {
            $i['msg'] = 'Pj Order';
            $res[] = $i;
        } else if ($i['pj_uangkeluar'] == session('username')) {
            $i['msg'] = 'Pj Uang Keluar';
            $res[] = $i;
        } else if ($i['penerima_uangmasuk'] == session('username')) {
            $i['msg'] = 'Penerima Uang Masuk';
            $res[] = $i;
        } else if ($i['username'] == session('username')) {
            $i['msg'] = 'Penerima Order';
            $res[] = $i;
        }
    }

    foreach ($res as $key => $i) {
        if ($key < 7) {
            $val[] = $i;
        }
    }




    return $val;
}

function tugasNow()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;

    $q = $cols->groupBy('pj_order')->find();

    $res = [];

    foreach ($q as $i) {

        $v = $cols->where('pj_order', $i['pj_order'])->find();
        $res[] = [
            'pj_order' => $i['pj_order'],
            'data' => $v
        ];
    }
    return $res;
}


function paginationtugas($page, $row = 7, $spage = 3)
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;
    $q = $cols->orderBy('tgl', 'DESC')->findAll();

    $res = [];


    if (session('role') == 'Bendahara' || session('role') == 'Root') {
        foreach ($q as $key => $i) {
            $i['msg'] = session('role');
            $res[] = $i;
        }
    } else {
        foreach ($q as $key => $i) {
            if ($i['pj_order'] == session('username')) {
                $i['msg'] = 'Pj Order';
                $res[] = $i;
            } else if ($i['pj_uangkeluar'] == session('username')) {
                $i['msg'] = 'Pj Uang Keluar';
                $res[] = $i;
            } else if ($i['penerima_uangmasuk'] == session('username')) {
                $i['msg'] = 'Penerima Uang Masuk';
                $res[] = $i;
            } else if ($i['username'] == session('username')) {
                $i['msg'] = 'Penerima Order';
                $res[] = $i;
            }
        }
    }

    $totalpage = ceil(count($res) / $row);

    $start = ($page * $row) - $row;
    $end = $start + $row;

    $data = [];

    if (session('role') == 'Bendahara' || session('role') == 'Root') {
        foreach ($res as $key => $i) {
            if ($key >= $start && $key < $end) {
                $i['msg'] = session('role');
                $data[] = $i;
            }
        }
    } else {
        foreach ($res as $key => $i) {
            if ($key >= $start && $key < $end) {
                if ($i['pj_order'] == session('username')) {
                    $i['msg'] = 'Pj Order';
                    $data[] = $i;
                } else if ($i['pj_uangkeluar'] == session('username')) {
                    $i['msg'] = 'Pj Uang Keluar';
                    $data[] = $i;
                } else if ($i['penerima_uangmasuk'] == session('username')) {
                    $i['msg'] = 'Penerima Uang Masuk';
                    $data[] = $i;
                } else if ($i['username'] == session('username')) {
                    $i['msg'] = 'Penerima Order';
                    $data[] = $i;
                }
            }
        }
    }

    $showpage = [];
    if ($totalpage <= $spage && $page <= $spage) {
        for ($i = 0; $i < $spage; $i++) {
            $showpage[] = $i + 1;
        }
    } else {

        if ($page % $spage == 1) {
            $showpage[] = $page;
            $showpage[] = $page + 1;
            $showpage[] = $page + 2;
        }
        if ($page % $spage == 2) {
            $showpage[] = $page - 1;
            $showpage[] = $page;
            $showpage[] = $page + 1;
        }
        if ($page % $spage == 0) {
            $showpage[] = $page - 2;
            $showpage[] = $page - 1;
            $showpage[] = $page;
        }
    }

    $val = [
        'page' => $page,
        'showpage' => $showpage,
        'last' => $totalpage,
        'data' => $data
    ];
    return $val;
}

function caritugas($val)
{
    $mod = \App\Models\Transaksis::class;
    $mod = new $mod;

    $q = $mod->where('pj_order', session('username'))->like('produk', $val, 'both')->find();

    $res = [];
    foreach ($q as $i) {
        if (!in_array($i['produk'], $res)) {
            $res[] = $i['produk'];
        }
    }

    return $res;
}

function searchtugas($search)
{
    $mod = \App\Models\Transaksis::class;
    $mod = new $mod;

    $q = $mod->where('pj_order', session('username'))->like('produk', $search, 'both')->find();
    $res = [];
    foreach ($q as $i) {
        if ($i['pj_order'] == session('username')) {
            $i['msg'] = 'Pj Order';
            $res[] = $i;
        } else if ($i['pj_uangkeluar'] == session('username')) {
            $i['msg'] = 'Pj Uang Keluar';
            $res[] = $i;
        } else if ($i['penerima_uangmasuk'] == session('username')) {
            $i['msg'] = 'Penerima Uang Masuk';
            $res[] = $i;
        } else if ($i['username'] == session('username')) {
            $i['msg'] = 'Penerima Order';
            $res[] = $i;
        }
    }
    return $res;
}

function counttugas()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;

    $q = $cols->findAll();

    $res = [];

    foreach ($q as $key => $i) {
        if ($i['pj_order'] == session('username')) {
            $i['msg'] = 'Pj Order';
            $res[] = $i;
        } else if ($i['pj_uangkeluar'] == session('username')) {
            $i['msg'] = 'Pj Uang Keluar';
            $res[] = $i;
        } else if ($i['penerima_uangmasuk'] == session('username')) {
            $i['msg'] = 'Penerima Uang Masuk';
            $res[] = $i;
        } else if ($i['username'] == session('username')) {
            $i['msg'] = 'Penerima Order';
            $res[] = $i;
        }
    }
    $count = 0;

    foreach ($res as $i) {
        if ($i['progres'] !== 'Selesai') {
            $count = $count + 1;
        }
    }

    return $count;
}

function djana()
{
    $db = \App\Models\Users::class;
    $db = new $db;

    $where = ['User', 'Guest'];
    $q = $db->whereNotIn('role', $where)->find();
    return $q;
}

function now()
{
    $d = intval(date('d'));
    return $d . '-' . date('n-Y H:i:s');
}

function statistik($order)
{
    $db = \App\Models\Transaksis::class;
    $db = new $db;

    $q = $db->groupBy($order)->find();

    $res = [];

    foreach ($q as $i) {
        $v = $db->where($order, $i[$order])->find();

        $res[] = [
            'count' => count($v),
            'data' => $i
        ];
    }

    return $res;
}

function alay()
{
    $cols = \App\Models\Transaksis::class;
    $cols = new $cols;


    $order = ['username', 'pj_order', 'pj_uangkeluar', 'penerima_uangmasuk'];

    $res = [];

    foreach ($order as $i) {
        $q = $cols->groupBy($i)->find();

        foreach ($q as $v) {

            $qu = $cols->where($i, $v[$i])->find();

            foreach ($qu as $q) {
                if (array_key_exists($q[$i], $res)) {
                    $res[$q[$i]] =  $res[$q[$i]] + 1;
                } else {
                    $res[$q[$i]] = 1;
                }
            }
        }
    }
    asort($res);
    $val = [];
    foreach ($res as $key => $i) {
        $val[] = [
            'username' => $key,
            'count' => $i
        ];
    }

    $last = [];
    if (count($val) > 0) {
        $db = \App\Models\Users::class;
        $db = new $db;
        foreach ($val as $i) {
            if ($i['username'] !== '') {
                $last = $db->select('id,username,nama,image, role')->where('username', $i['username'])->first();
                if ($last) {
                    $last['keterlibatan'] = $i['count'];
                    if ($last['role'] == 'Editor' || $last['role'] == 'Staff') {
                        break;
                    }
                }
            }
        }
    }
    return $last;
}

function no_inv()
{
    $db = \App\Models\Invs::class;
    $db = new $db;
    $q = $db->orderBy('id', 'DESC')->first();
    $d = intval(date('d'));
    $m = date('n');
    $y = date('y');
    $no_inv = $d . '/' . date('n/y') . '/1';

    if ($q) {
        if ($q['no_inv'] !== '') {
            $exp = explode("/", $q['no_inv']);

            if ($y == $exp[2] && $m == $exp[1] && $d == $exp[0]) {
                $no = end($exp) + 1;
                $no_inv = $exp[0] . '/' . $exp[1] . '/' . $exp[2] . '/' . $no;
            } else if ($y == $exp[2] && $m == $exp[1] && $d !== $exp[0]) {
                $no_inv = $d . '/' . $exp[1] . '/' . $exp[2] . '/1';
            } else if ($y == $exp[2] && $m !== $exp[1]) {
                $no_inv = '1/' . $m . '/' . $exp[2] . '/1';
            } else if ($y !== $exp[2]) {
                $no_inv = '1/1/' . $y . '/1';
            }
        }
    }
    return $no_inv;
}

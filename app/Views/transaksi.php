<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('functions');
// dd($data);
?>

<!-- KERANJANG -->
<div class="container mb-3" style="margin-top:70px;">
    <!-- SEARCH -->
    <div class="d-sm-block d-md-none" style="margin-bottom:100px;">
        <div class="input-group input-group-sm p-2 fixed-top bg-light" style="top:50px;">
            <span class="input-group-text" style="background-color:transparent; border:none;">Cari Transaksi</span>
            <input type="text" placeholder="Contoh: Monitor" data-display="sm" class="form-control caritransaksi" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
            <a class="btn btn-outline-secondary" href="<?= base_url(); ?>/transaksi" type="button"><i class="fa fa-trash"></i></a>
        </div>
        <div class="list-group bodysm" style="margin-top:-4px; margin-left:88px;width:68%; position:absolute;z-index:28">

        </div>
    </div>
    <div class="d-none d-md-block mb-2">
        <div class="input-group input-group-sm bg-transparent">
            <span class="input-group-text" style="background-color:transparent; border:none;">Cari Transaksi</span>
            <input type="text" placeholder="Contoh: Monitor" data-display="md" class="form-control caritransaksi" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
            <a class="btn btn-outline-secondary" href="<?= base_url(); ?>/transaksi" type="button"><i class="fa fa-trash"></i></a>
        </div>
        <div class="list-group bodymd" style="margin-top:6px; margin-left:93px; width:40%;position:absolute;z-index:28">

        </div>
    </div>
    <?php if (count($data) == 0) : ?>
        <p style="font-size:small;">Tidak ada barang di keranjang. <a href="<?= base_url(); ?>/produk">Belanja sekarang</a></p>
    <?php else : ?>
        <?php foreach ($data as $i) : ?>
            <div class="list-group mb-1">
                <a href="<?= base_url(); ?>/transaksi/detail/<?= str_replace("/", "-", $i['no_nota']); ?>" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between mb-1" style="border-bottom:1px solid #F5F5F5;padding-bottom:10px;">
                        <div>
                            <small><i class="fa fa-clock-o"></i> <?= $i['tgl']; ?></small>
                            <small>| No. Transaksi: <?= $i['no_nota']; ?></small>
                        </div>
                        <small><span class="badge rounded-pill text-<?= progres($i['progres'])['color']; ?>"><?= progres($i['progres'])['icon']; ?> <?= $i['progres']; ?></span></small>
                    </div>
                    <p class="mb-1"><?= $i['ket']; ?> | <?= $i['penerima_order']; ?>. Pj order <?= $i['pj_order']; ?></p>
                    <small><?= $i['username']; ?> | <?= $i['produk']; ?> <?= ($i['jml_barang'] > 1 ? 'dan ' . $i['jml_barang'] - 1 . ' barang lainnya' : ''); ?></small>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <nav class="mt-2" aria-label="...">
        <ul class="pagination pagination-sm">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="<?= base_url(); ?>/transaksi/page/1">1</a></li>
            <li class="page-item" aria-current="page">
                <a class="page-link" href="<?= base_url(); ?>/transaksi/page/2">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="<?= base_url(); ?>/transaksi/page/3">3</a></li>
            <li class="page-item">
                <a class="page-link" href="<?= base_url(); ?>/transaksi/page/2">Next</a>
            </li>
        </ul>
    </nav>
</div>

<?= $this->endSection(); ?>
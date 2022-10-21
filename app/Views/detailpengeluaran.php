<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
// helper('functions');
?>

<div class="container p-2" style="margin-top:70px;">


    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Jenis</span>
        <input type="text" class="form-control" value="<?= $data['ket']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Tgl.</span>
        <input type="text" class="form-control" value="<?= $data['tgl']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Pj.</span>
        <input type="text" value="<?= $data['pj_order']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Produk</span>
        <input type="text" value="<?= $data['produk']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Uang Keluar</span>
        <input type="text" value="<?= 'Rp ' . rupiah($data['uang_keluar']); ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Pj. Uang Keluar</span>
        <input type="text" value="<?= $data['pj_uangkeluar']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Tgl. Uang Keluar</span>
        <input type="text" value="<?= $data['tgl_uangkeluar']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Catatan</span>
        <textarea class="form-control" aria-label="With textarea" readonly><?= $data['catatan']; ?></textarea>
    </div>

    <label style="font-size:small">Nota</label>
    <div>
        <img class="img-fluid" src="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" alt="Nota">

    </div>
    <div class="mt-2">
        <a download="<?= $data['nota_uangkeluar']; ?>" href="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" title="<?= $data['nota_uangkeluar']; ?>" type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary">Download</a>
    </div>


</div>


<?= $this->endSection(); ?>
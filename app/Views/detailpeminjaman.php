<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>

<?php
// helper('functions');
// dd($data);
?>

<div class="container mb-3" style="margin-top:80px;">
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Tgl</span>
        <input value="<?= $data['tgl']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Peminjam</span>
        <input value="<?= $data['peminjam']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Petugas</span>
        <input value="<?= $data['petugas']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Barang</span>
        <input value="<?= $data['barang']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Jml</span>
        <input value="<?= $data['jml']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Biaya</span>
        <input value="<?= $data['biaya']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Tgl. Dikembalikan</span>
        <input value="<?= $data['tgl_dikembalikan']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Petugas</span>
        <input value="<?= $data['penerima_uang']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Kondisi</span>
        <input value="<?= $data['kondisi']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Catatan</span>
        <input value="<?= $data['catatan']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Ket</span>
        <input value="<?= $data['ket']; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
</div>


<?= $this->endSection(); ?>
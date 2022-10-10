<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php
// helper('form');
?>

<div class="container p-2" style="margin-top:70px;">
    <form action="<?= base_url(); ?>/peminjaman" method="POST">
        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Barang</label>
            <select class="form-select" name="barang">
                <?php foreach ($data as $i) : ?>
                    <option value="<?= $i['id']; ?>"><?= $i['barang']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Petugas Djana</label>
            <select class="form-select" name="petugas">
                <?php foreach ($djana as $i) : ?>
                    <?php if ($i['role'] !== 'Root') : ?>
                        <option value="<?= $i['username']; ?>"><?= $i['nama']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Jumlah</span>
            <input type="number" name="jml" class="form-control" placeholder="Jumlah" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Kondisi</label>
            <select class="form-select" name="kondisi">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Tgl. Dikembalikan</span>
            <input type="text" name="catatan" class="form-control" placeholder="Tanggal dikembalikan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-sm btn-primary">
                Save
            </button>
        </div>
    </form>


</div>


<?= $this->endSection(); ?>
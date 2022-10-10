<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php
// helper('form');
?>

<div class="container p-2" style="margin-top:70px;">
    <form action="<?= base_url(); ?>/peminjaman/update" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Barang</span>
            <input type="text" name="barang" class="form-control" value="<?= $data['barang']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Batas Peminjaman</span>
            <input type="text" name="catatan" class="form-control" value="<?= $data['catatan']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Biaya</span>
            <input type="number" name="biaya" class="form-control" placeholder="Biaya" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>

        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Petugas Djana</label>
            <select class="form-select" name="penerima_uang">
                <?php foreach ($djana as $i) : ?>
                    <?php if ($i['role'] !== 'Root') : ?>
                        <option value="<?= $i['username']; ?>"><?= $i['nama']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Kondisi</label>
            <select class="form-select" name="kondisi">
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-sm btn-primary">
                Save
            </button>
        </div>
    </form>


</div>


<?= $this->endSection(); ?>
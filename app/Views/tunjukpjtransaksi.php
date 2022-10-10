<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php

?>

<div class="container p-2" style="margin-top:70px;">
    <form action="<?= base_url('transaksi'); ?>/tunjukpj" method="POST">
        <input type="hidden" name="no_nota" value="<?= $nota; ?>">
        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Tentukan Pj</label>
            <select class="form-select" name="pj_order">
                <?php foreach ($data as $i) : ?>
                    <option value="<?= $i['username']; ?>"><?= $i['nama']; ?></option>
                <?php endforeach; ?>
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
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php
helper('form');
?>

<div class="container p-2" style="margin-top:70px;">
    <?= form_open_multipart(base_url() . '/produk') ?>
    <div class="input-group input-group-sm mb-3">
        <label style="width:150px;" class="input-group-text">Jenis</label>
        <select class="form-select" name="jenis">
            <?php foreach ($jenis as $i) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Nama Produk</span>
        <input type="text" name="produk" class="form-control" placeholder="Nama produk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Harga Beli</span>
        <input type="number" name="harga_beli" class="form-control" placeholder="Harga beli" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Harga Jual</span>
        <input type="number" name="harga_jual" class="form-control" placeholder="Harga jual" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Toko/Link Pembelian</span>
        <input type="text" name="link_pembelian" class="form-control" placeholder="Toko/link pembelian" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Deskripsi</span>
        <textarea class="form-control" name="detail_produk" aria-label="With textarea" required></textarea>
    </div>

    <div class="mb-3">
        <label for="formFileSm" class="form-label">Gambar Produk</label>
        <input class="form-control form-control-sm" name="gambar" type="file">
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            Save
        </button>
    </div>
    </form>


</div>


<?= $this->endSection(); ?>
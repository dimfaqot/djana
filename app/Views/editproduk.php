<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php
helper('form');

?>

<div class="container p-2" style="margin-top:70px;">
    <?= form_open_multipart(base_url() . '/produk/' . ($order == 'Edit' ? 'update' : '')) ?>
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <div class="input-group input-group-sm mb-3">
        <label style="width:150px;" class="input-group-text">Jenis</label>
        <select class="form-select" name="jenis">
            <?php foreach ($jenis as $i) : ?>
                <?php if ($data['jenis'] == $i) : ?>
                    <option selected value="<?= $i; ?>"><?= $i; ?></option>

                <?php else : ?>
                    <option value="<?= $i; ?>"><?= $i; ?></option>

                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Nama Produk</span>
        <input type="text" name="produk" class="form-control" value="<?= $data['produk']; ?>" placeholder="Nama produk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Harga Beli</span>
        <input type="number" name="harga_beli" value="<?= $data['harga_beli']; ?>" class="form-control" placeholder="Harga beli" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Harga Jual</span>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual']; ?>" class="form-control" placeholder="Harga jual" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Toko/Link Pembelian</span>
        <input type="text" name="link_pembelian" value="<?= $data['link_pembelian']; ?>" class="form-control" placeholder="Toko/link pembelian" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Deskripsi</span>
        <textarea class="form-control" name="detail_produk" aria-label="With textarea" required><?= $data['detail_produk']; ?></textarea>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:160px;" class="input-group-text">Gambar Produk</span>

        <div style="background-image:url('<?= base_url(); ?>/images/<?= $data['gambar']; ?>'); width:300px;height:300px; background-size:cover; background-position:center;"></div>
        <div class="input-group input-group-sm mt-3">
            <input type="file" name="gambar" class="form-control">
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            Save
        </button>
    </div>
    </form>


</div>


<?= $this->endSection(); ?>
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('form');
?>

<div class="container p-2" style="margin-top:70px;">

    <?= form_open_multipart(base_url() . '/pengeluaran'); ?>
    <div class="input-group input-group-sm mb-3">
        <label style="width:150px;" class="input-group-text">Jenis</label>
        <select class="form-select" name="ket">
            <?php foreach ($jenis as $i) : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Nama Produk</span>
        <input type="text" name="produk" class="form-control" placeholder="Nama produk atau kegiatan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Uang Keluar</span>
        <input type="number" name="uang_keluar" class="form-control" placeholder="Uang yang dikeluarkan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Ket. Uang Keluar</span>
        <input type="text" name="ket_uangkeluar" class="form-control" placeholder="Dp/lunas, dll" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Catatan</span>
        <textarea class="form-control" name="catatan" placeholder="Toko/tempat service/penerima donasi dan info lainnya" aria-label="With textarea" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label" style="font-size:small;">Nota/kwitansi</label>
        <input type="file" name="nota_uangkeluar" class="form-control form-control-sm">
    </div>


    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            Save
        </button>
    </div>
    </form>

</div>


<?= $this->endSection(); ?>
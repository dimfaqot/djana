<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('form');
// dd($jenis);
?>

<div class="container p-2" style="margin-top:70px;">

    <?= form_open_multipart(base_url() . '/pengeluaran/update'); ?>
    <input type="hidden" name="id" value="<?= $data['id']; ?>">
    <div class="input-group input-group-sm mb-3">
        <label style="width:150px;" class="input-group-text">Jenis</label>
        <select class="form-select" name="ket">
            <?php foreach ($jenis as $i) : ?>
                <?php if ($data['ket'] == $i) : ?>
                    <option selected value="<?= $i; ?>"><?= $i; ?></option>

                <?php else : ?>
                    <option value="<?= $i; ?>"><?= $i; ?></option>

                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Nama Produk</span>
        <input type="text" name="produk" value="<?= $data['produk']; ?>" class="form-control" placeholder="Nama produk atau kegiatan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Uang Keluar</span>
        <input type="number" name="uang_keluar" value="<?= $data['uang_keluar']; ?>" class="form-control" placeholder="Uang yang dikeluarkan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Ket. Uang Keluar</span>
        <input type="text" name="ket_uangkeluar" value="<?= $data['ket_uangkeluar']; ?>" class="form-control" placeholder="Dp/lunas, dll" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>

    <div class="input-group input-group-sm mb-3">
        <span style="width:150px;" class="input-group-text">Catatan</span>
        <textarea class="form-control" name="catatan" placeholder="Toko/tempat service/penerima donasi dan info lainnya" aria-label="With textarea" required><?= $data['catatan']; ?></textarea>
    </div>
    <div class="input-group input-group-sm mb-3">
        <span style="width:160px;" class="input-group-text">Nota. Uang Keluar</span>
        <a href="#" data-bs-toggle="modal" data-bs-target="#nota">

            <div style="background-image:url('<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>'); width:100px;height:100px; background-size:cover; background-position:center;"></div>

        </a>
    </div>
    <div class="mb-3">
        <input type="file" name="nota_uangkeluar" class="form-control form-control-sm">
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            Save
        </button>
    </div>
    </form>

</div>

<div class="modal fade" id="nota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Nota <?= $data['ket']; ?> <?= $data['produk']; ?></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img class="img-fluid" src="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" alt="Nota">
            </div>
            <div class="modal-footer">
                <a download="<?= $data['nota_uangkeluar']; ?>" href="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" title="<?= $data['nota_uangkeluar']; ?>" type="button" class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
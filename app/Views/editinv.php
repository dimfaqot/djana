<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php
$con = \App\Models\Configs::class;
$con = new $con;
$kondisi = $con->kondisi();
?>

<div class="container p-2" style="margin-top:70px;">
    <form action="<?= base_url('inventaris'); ?>" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Tempat</span>
            <input type="text" name="tempat" class="form-control" value="<?= $data['tempat']; ?>" placeholder="Tempat inv disimpan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>
        <div class="input-group input-group-sm mb-3">
            <label style="width:150px;" class="input-group-text">Kondisi</label>
            <select class="form-select" name="kondisi">
                <?php foreach ($kondisi as $i) : ?>
                    <?php if ($data['kondisi'] == $i) : ?>
                        <option selected value="<?= $i; ?>"><?= $i; ?></option>

                    <?php else : ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>

                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Catatan</span>
            <textarea class="form-control" placeholder="Catatan" name="catatan" aria-label="With textarea" required><?= $data['catatan']; ?></textarea>
        </div>


        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-sm btn-primary">
                Save
            </button>
        </div>
    </form>


</div>


<?= $this->endSection(); ?>
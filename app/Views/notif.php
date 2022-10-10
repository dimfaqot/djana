<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
// dd($data);

?>
<div class="container" style="margin-top:70px;">
    <?php if (count($data) == 0) : ?>
        <p class="card-text"><small class="text-muted">Tidak ada notif! <a style="text-decoration:none;" href="<?= base_url(); ?>/produk">Belanja</a></small></p>
    <?php else : ?>

        <div class="input-group input-group-sm" style="position:fixed;z-index:7;width:60%">
            <span class="input-group-text" style="background-color:transparent; border:none;">Cari Notif</span>
            <input type="text" placeholder="..." class="form-control carinotif" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
        </div>


        <br>
        <br>
        <?php foreach ($data as $i) : ?>
            <div class="list-group mb-1 listcarinotif" data-lists="<?= $i['subjek']; ?> <?= ucfirst($i['order']); ?>">
                <a href="<?= base_url(); ?>/notif/detail/<?= $i['id']; ?>" class="list-group-item list-group-item-action <?= ($i['read'] == 0 ? 'active' : ''); ?>" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1"><?= $i['subjek']; ?></h6>
                        <small style="font-size:x-small"><?= $i['tgl']; ?></small>
                    </div>
                    <p class="mb-1" style="font-size:small"><?= ucfirst($i['order']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?= $this->endSection(); ?>
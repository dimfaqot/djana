<?= $this->extend('templates/guest'); ?>

<?= $this->section('content'); ?>

<div class="container p-2">
    <?php

    // dd($data);
    ?>
    <!-- SEARCH -->
    <div class="d-sm-block d-md-none" style="margin-bottom:100px;">
        <div class="input-group input-group-sm p-2 fixed-top bg-light" style="top:50px;">
            <span class="input-group-text" style="background-color:transparent; border:none;">Cari Produk</span>
            <input type="text" placeholder="Contoh: Monitor" data-display="sm" class="form-control cariproduk" value="<?= $val; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
            <a class="btn btn-outline-secondary" href="<?= base_url(); ?>" type="button"><i class="fa fa-trash"></i></a>
        </div>
        <div class="list-group bodysm" style="margin-top:88px; margin-left:82px;width:70%; position:absolute;z-index:28">

        </div>
    </div>
    <div class="d-none d-md-block" style="margin-bottom:80px;">
        <div class="input-group input-group-sm bg-transparent" style="top:70px;">
            <span class="input-group-text" style="background-color:transparent; border:none;">Cari Produk</span>
            <input type="text" placeholder="Contoh: Monitor" data-display="md" class="form-control cariproduk" value="<?= $val; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
            <a class="btn btn-outline-secondary" href="<?= base_url(); ?>" type="button"><i class="fa fa-trash"></i></a>
        </div>
        <div class="list-group bodymd" style="margin-top:75px; margin-left:82px; width:40%;position:absolute;z-index:28">

        </div>
    </div>
    <!-- PRODUK -->
    <?php foreach ($data['jenis'] as $j) : ?>
        <h5><?= $j; ?></h5>
        <div class="row g-2 mb-3">
            <?php foreach ($data['produk'] as $i) : ?>
                <?php if ($j == $i['jenis']) : ?>

                    <div class="col-6 col-md-2">
                        <a href="<?= base_url(); ?>/home/detailproduk/<?= $i['id']; ?>" style="text-decoration:none; color: rgb(83, 83, 83);">
                            <div class="card cardproduk">
                                <div style="background-image:url('<?= base_url(); ?>/images/<?= $i['gambar']; ?>'); height: 250px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 10px 10px 0px 0px;"></div>
                                <div class="card-body bodycardproduk">
                                    <h6 class="card-title kategoriproduk"><?= $i['jenis']; ?></h6>
                                    <h6 style="font-weight:normal;"><?= $i['produk']; ?></h6>
                                    <h6>Rp <?= rupiah($i['harga_jual']); ?></h6>
                                    <h6><i class="fa fa-shopping-bag" style="color:rgb(29, 158, 65)"></i> Djana</h6>
                                    <hr>
                                    <div class="d-flex gap-2">
                                        <form action="<?= base_url(); ?>/keranjang" method="post">
                                            <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                            <button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href=""><i class="fa fa-shopping-basket"></i> Keranjang</button>
                                        </form>

                                        <button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" href=""><i class="fa fa-commenting"></i> Chat</button>
                                    </div>
                                    <form action="<?= base_url(); ?>/keranjang" method="post">
                                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                                        <div class="d-grid gap-2 mt-3">
                                            <button class="btn btn-sm btn-success" type="submit">Beli</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

</div>

<?= $this->endSection(); ?>
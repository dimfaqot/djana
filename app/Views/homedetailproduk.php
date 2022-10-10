<?= $this->extend('templates/guest'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<div class="container mb-3" style="margin-top:80px;">
    <div class="row g-3">
        <div class="col-md-4">
            <div class="mb-2" style="background-image:url('<?= base_url(); ?>/images/p.jpeg'); height: 400px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 10px"></div>
            <div class="d-flex gap-2">
                <a href="#">
                    <div style="background-image:url('<?= base_url(); ?>/images/p.jpeg'); height: 50px; width: 50px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 5px; border: 1px solid green;"></div>
                </a>
                <a href="#">
                    <div style="background-image:url('<?= base_url(); ?>/images/p.jpeg'); height: 50px; width: 50px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 5px"></div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <h6 class="card-title kategoriproduk">Barang</h6>
            <h5>Lorem, ipsum dolor.</h5>
            <h5>Rp 50.000</h5>
            <h6><i class="fa fa-shopping-bag" style="color:rgb(29, 158, 65)"></i> Djana</h6>
            <hr>
            Detail
            <hr>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui quae error soluta voluptas autem consequuntur a. Labore atque beatae omnis itaque, laborum iste libero recusandae ducimus aut quis quisquam tenetur dignissimos</p>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <textarea class="form-control mb-3" placeholder="Catatan untuk penjual" rows="3"></textarea>
                    <div class="d-grid gap-2 mb-3">
                        <form action="<?= base_url(); ?>/keranjang" method="post">
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-sm btn-success" type="submit">Beli</button>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-between">
                        <form action="<?= base_url(); ?>/keranjang" method="post">
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            <button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;" href=""><i class="fa fa-shopping-basket"></i> Keranjang</button>
                        </form>
                        <a style="text-decoration:none; color:rgb(69, 69, 69);" href=""><i class="fa fa-commenting"></i> Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container p-2">
    <!-- PRODUK -->
    <?php foreach ($produk['jenis'] as $j) : ?>
        <h5><?= $j; ?></h5>
        <div class="row g-2 mb-3">
            <?php foreach ($produk['produk'] as $i) : ?>
                <?php if ($j == $i['jenis']) : ?>

                    <div class="col-6 col-md-2">
                        <a href="<?= base_url(); ?>/produk/detail/<?= $i['id']; ?>" style="text-decoration:none; color: rgb(83, 83, 83);">
                            <div class="card cardproduk">
                                <div style="background-image:url('<?= base_url(); ?>/images/<?= $i['gambar']; ?>'); height: 250px; width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 10px 10px 0px 0px;"></div>
                                <div class="card-body bodycardproduk">
                                    <h6 class="card-title kategoriproduk"><?= $i['jenis']; ?></h6>
                                    <h6 style="font-weight:normal;"><?= $i['produk']; ?></h6>
                                    <h6>Rp <?= rupiah($i['harga_jual']); ?></h6>
                                    <h6><i class="fa fa-shopping-bag" style="color:rgb(29, 158, 65)"></i> <?= $i['petugas_produk']; ?></h6>
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
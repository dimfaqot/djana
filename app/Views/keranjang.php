<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('functions');
// dd(keranjang());
$total = 0;
?>

<!-- KERANJANG -->
<div class="container mb-3" style="margin-top:70px;">

    <?php foreach (keranjang() as $i) : ?>
        <?php
        if ($i['pilih'] == 1) {
            $total = $total + ($i['harga_jual'] *  $i['quantity_keranjang']);
        }

        ?>
        <div class="row gap-3 gap-md-1">
            <!-- <h6><i class="fa fa-shopping-bag" style="color:rgb(29, 158, 65)"></i> Djana</h6> -->
            <div class="col-1 col-md-1">
                <input class="form-check-input pilih pilih<?= $i['id']; ?>" name="produk" data-order="pilih" type="checkbox" data-qty=<?= $i['quantity_keranjang']; ?> data-harga="<?= $i['harga_jual']; ?>" value="<?= $i['id']; ?>" <?= ($i['pilih'] == 1 ? 'checked' : ''); ?>>
            </div>
            <div class="col-3 col-md-1">
                <a href="<?= base_url(); ?>/produk/detailproduk/<?= $i['id']; ?>">
                    <div style="background-image:url('<?= base_url(); ?>/images/<?= $i['gambar']; ?>'); height: 100px; width: 100px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 5px; border: 1px solid green;"></div>
                </a>
            </div>
            <div class="col-7 col-md">
                <h6 class="card-title kategoriproduk"><?= $i['jenis']; ?></h6>
                <h6 style="font-weight:normal;"><?= $i['produk']; ?></h6>
                <h6><?= rupiah($i['harga_jual']); ?></h6>
                <div class="input-group input-group-sm mb-3">
                    <button class="btn btn-outline-secondary btneditkeranjang" data-order="kurang" data-id="<?= $i['id']; ?>" type="button">-</button>
                    <input type="text" placeholder="Jumlah" value="<?= $i['quantity_keranjang']; ?>" data-id="<?= $i['id']; ?>" data-order="editkeranjang" class="form-control editkeranjang submitjumlah<?= $i['id']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <button class="btn btn-outline-secondary btneditkeranjang" data-id="<?= $i['id']; ?>" data-order="tambah" type="button">+</button>
                </div>
            </div>
            <div class="container">
                <textarea style="font-size:small" class="form-control mb-3 editkeranjang catatan<?= $i['id']; ?>" data-id="<?= $i['id']; ?>" data-order="catatan" placeholder="Catatan untuk penjual" rows="3"><?= $i['catatan_keranjang']; ?></textarea>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (count(keranjang()) == 0) : ?>
        <p style="font-size:small;">Tidak ada barang di keranjang. <a href="<?= base_url(); ?>/produk">Belanja sekarang</a></p>

    <?php else : ?>
        <div class="card mb-3">
            <div class="card-body">
                <h6 data-total="<?= $total; ?>" class="total">TOTAL: Rp <?= rupiah($total); ?></h6>
            </div>
        </div>
        <div class="d-grid">
            <?php if (session('role') !== 'User' && session('role') !== 'Guest') : ?>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="inventaris" type="checkbox" role="switch">
                    <label class="form-check-label">Inventaris</label>
                </div>
            <?php endif; ?>
            <button class="btn btn-success btn-sm transaksi" type="button">Beli</button>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('functions');
// dd($data);
$total = 0;
?>

<!-- KERANJANG -->
<div class="container mb-3" style="margin-top:70px;">
    <div class="card">
        <div class="card-body">
            <?php foreach ($data as $key => $i) : ?>
                <?php
                $total = $total + $i['jumlah'];
                ?>
                <?php if ($key == 0) : ?>
                    <div class="d-flex justify-content-center">
                        <div style="text-align:center; color:<?= ($i['progres'] == 'Menunggu' ? '#5DB661' : '#9E9E9E'); ?>">
                            <i style="font-size:20px;" class="fa fa-spinner"></i>
                            <p style="font-size:small">Menunggu</p>

                        </div>
                        <div>
                            -------
                        </div>
                        <div style="text-align:center; color:<?= ($i['progres'] == 'Proses' ? '#5DB661' : '#9E9E9E'); ?>">
                            <i style="font-size:20px;" class="fa fa-space-shuttle"></i>
                            <p style="font-size:small">Proses</p>

                        </div>
                        <div>
                            -------
                        </div>
                        <div style="text-align:center; color:<?= ($i['progres'] == 'Pembayaran' ? '#5DB661' : '#9E9E9E'); ?>">
                            <i style="font-size:20px;" class="fa fa-money"></i>
                            <p style="font-size:small">Pembayaran</p>

                        </div>
                        <div>
                            -------
                        </div>
                        <div style="text-align:center; color:<?= ($i['progres'] == 'Selesai' ? '#5DB661' : '#9E9E9E'); ?>">
                            <i style="font-size:20px;" class="fa fa-check-circle"></i>
                            <p style="font-size:small">Selesai</p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div style="font-size:small"><span style="width:100px; display:inline-block">Tanggal</span> : <?= $i['tgl']; ?></div>
                            <div style="font-size:small"><span style="width:100px; display:inline-block">No. Transaksi</span> : <?= $i['no_nota']; ?></div>

                        </div>
                        <div class="col-md-6">
                            <div style="font-size:small"><span style="width:100px; display:inline-block">Petugas</span> : <?= $i['penerima_order']; ?></div>
                            <div style="font-size:small"><span style="width:100px; display:inline-block">Pj</span> : <?= ucfirst($i['pj_order']); ?></div>

                        </div>
                    </div>
                    <hr>
                    <table class="table table-sm" style="font-size:small">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Barang</th>
                                <th scope="col">qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th style="width:300px;" class="d-none d-md-table-cell" scope="col">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php endif; ?>
                        <tr>
                            <td scope="row"><?= $key + 1; ?></td>
                            <td><?= $i['produk']; ?></td>
                            <td><?= $i['qty']; ?></td>
                            <td>Rp <?= rupiah($i['harga']); ?></td>
                            <td>Rp <?= rupiah($i['jumlah']); ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['catatan']; ?></td>
                        </tr>
                        <?php if (($key + 1) == count($data)) : ?>
                            <tr style="background-color:#E0E0E0">
                                <td></td>
                                <td>TOTAL</td>
                                <td></td>
                                <td></td>
                                <td>Rp <?= rupiah($total); ?></td>
                                <td class="d-none d-md-table-cell"></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="d-grid gap-2">
                <?php if (session('role') == 'Root' || session('role') == 'Admin' || session('role') == 'Bendahara' && $data[0]['pj_order'] == '') : ?>
                    <a href="<?= base_url(); ?>/transaksi/tunjukpj/<?= str_replace("/", "-", $nota); ?>" type="button" class="btn btn-info" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Tunjuk Pj
                    </a>
                <?php endif; ?>
                <a target="_blank" href="<?= base_url(); ?>/transaksi/nota/<?= str_replace("/", "-", $nota); ?>" type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Cetak Nota
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
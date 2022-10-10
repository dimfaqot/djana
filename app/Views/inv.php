<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<!-- PESAN MESSAGE -->
<div class="container" style="margin-top: 70px;">
    <div class="input-group input-group-sm" style="position:fixed;z-index:7;width:60%">
        <span class="input-group-text" style="background-color:transparent; border:none;">Cari Inv</span>
        <input type="text" placeholder="..." class="form-control cariinv" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
    </div>
    <br>
    <br>
    <table class="table table-sm" style="font-size:small">
        <thead>
            <tr>
                <th>#</th>
                <th class="d-none d-md-table-cell">Tgl</th>
                <th class="d-none d-md-table-cell">Pembeli</th>
                <th>No. Inv</th>
                <th>Barang</th>
                <th class="d-none d-md-table-cell">Qty</th>
                <th class="d-none d-md-table-cell">Harga</th>
                <th class="d-none d-md-table-cell">Jumlah</th>
                <th class="d-none d-md-table-cell">Toko</th>
                <th>Tempat</th>
                <th class="d-none d-md-table-cell">Kondisi</th>
                <th style="width:300px;" class="d-none d-md-table-cell">Catatan</th>
            </tr>
        </thead>
        <tbody class="bodyinv">
            <?php foreach ($data as $key => $i) : ?>
                <tr data-val="<?= $i['barang']; ?> <?= $i['petugas']; ?>">
                    <td scope="row"><?= $key + 1; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['tgl']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['petugas']; ?></td>
                    <td><?= $i['no_inv']; ?></td>
                    <td><a href="<?= base_url(); ?>/inventaris/edit/<?= $i['id']; ?>"><?= $i['barang']; ?></a></td>
                    <td class="d-none d-md-table-cell"><?= $i['qty']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['harga']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['jumlah']; ?></td>
                    <td class="d-none d-md-table-cell"><a target="_blank" href="<?= $i['toko']; ?>"><?= (substr($i['toko'], 0, 4) == 'http' ? 'link' : $i['toko']); ?></a></td>
                    <td><?= $i['tempat']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['kondisi']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['catatan']; ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>



<?= $this->endSection(); ?>
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
// dd($data);
?>
<!-- DETAIL -->

<!-- PESAN MESSAGE -->
<div class="container" style="margin-top: 70px;">
    <div class="input-group input-group-sm" style="position:fixed;z-index:7;width:60%">
        <span class="input-group-text" style="background-color:transparent; border:none;">Cari Peminjaman</span>
        <input type="text" placeholder="..." class="form-control caripeminjaman" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
    </div>
    <br>
    <br>
    <table class="table table-sm" style="font-size:small">
        <thead>
            <tr>
                <th>#</th>
                <th>Tgl</th>
                <th>Peminjam</th>
                <th class="d-none d-md-table-cell">Djana</th>
                <th class="d-none d-md-table-cell">No. Inv</th>
                <th>Barang</th>
                <th class="d-none d-md-table-cell">Jml</th>
                <th class="d-none d-md-table-cell">Biaya</th>
                <th class="d-none d-md-table-cell">Djana</th>
                <th class="d-none d-md-table-cell">Dikembalikan</th>
                <th class="d-none d-md-table-cell">Kondisi</th>
                <th style="width:300px;" class="d-none d-md-table-cell">Catatan</th>
                <th class="d-none d-md-table-cell">Ket</th>
                <th class="d-none d-md-table-cell">Act</th>
            </tr>
        </thead>

        <a class="btn btn-primary btn-sm mb-2" href="<?= base_url(); ?>/peminjaman/add" role="button">Pinjam</a>
        <tbody class="bodyinv">
            <?php foreach ($data as $key => $i) : ?>
                <?php if (session('role') == 'User') : ?>
                    <?php if ($i['id_peminjam'] == session('id')) : ?>
                        <tr data-val="<?= $i['barang']; ?> <?= $i['petugas']; ?> <?= $i['peminjam']; ?>">
                            <td scope="row"><?= $key + 1; ?></td>
                            <td><?= $i['tgl']; ?></td>
                            <td><?= $i['peminjam']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['petugas']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['no_inv']; ?></td>
                            <td><?= $i['barang']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['jml']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['biaya']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['penerima_uang']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['tgl_dikembalikan']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['kondisi']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['catatan']; ?></td>
                            <td class="d-none d-md-table-cell"><?= $i['ket']; ?></td>
                            <?php if ($i['ket'] == 'Selesai') : ?>
                                <td class="d-none d-md-table-cell">-</td>
                            <?php else : ?>
                                <td class="d-none d-md-table-cell"><a href="<?= base_url(); ?>/peminjaman/edit/<?= $i['id']; ?>">Selesai</a></td>

                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php else : ?>
                    <tr data-val="<?= $i['barang']; ?> <?= $i['petugas']; ?> <?= $i['peminjam']; ?>">
                        <td scope="row"><?= $key + 1; ?></td>
                        <td><?= $i['tgl']; ?></td>
                        <td><?= $i['peminjam']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['petugas']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['no_inv']; ?></td>
                        <td><?= $i['barang']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['jml']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['biaya']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['penerima_uang']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['tgl_dikembalikan']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['kondisi']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['catatan']; ?></td>
                        <td class="d-none d-md-table-cell"><?= $i['ket']; ?></td>
                        <?php if ($i['ket'] == 'Selesai') : ?>
                            <td class="d-none d-md-table-cell">-</td>
                        <?php else : ?>
                            <td class="d-none d-md-table-cell"><a href="<?= base_url(); ?>/peminjaman/edit/<?= $i['id']; ?>">Selesai</a></td>

                        <?php endif; ?>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>



<?= $this->endSection(); ?>
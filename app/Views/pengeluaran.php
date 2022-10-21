<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<div class="container p-2" style="margin-top:70px;">
    <a href="<?= base_url(); ?>/pengeluaran/add" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
        Tambah
    </a>
    <input type="text" placeholder="Cari..." class="form-control form-control-sm my-2">
    <table class="table table-sm mb-3" style="font-size:small">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tgl</th>
                <th class="d-none d-md-table-cell" scope="col">Jenis</th>
                <th class="d-none d-md-table-cell" scope="col">Pj</th>
                <th scope="col">Barang</th>
                <th scope="col">Keluar(Rp)</th>
                <th class="d-none d-md-table-cell">Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $k => $i) : ?>
                <tr>
                    <td><?= $k + 1; ?></td>
                    <td><?= $i['tgl']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['ket']; ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['pj_order']; ?></td>
                    <td> <a href="#" data-bs-toggle="modal" data-bs-target="#pengeluaran<?= $i['id']; ?>"><?= $i['produk']; ?></td>
                    <td><?= rupiah($i['uang_keluar']); ?></td>
                    <td class="d-none d-md-table-cell"><?= $i['catatan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php foreach ($data as $i) : ?>
        <div class="modal fade" id="pengeluaran<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel"><?= $i['ket']; ?> <?= $i['produk']; ?></h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Tgl</label>
                            <input type="text" value="<?= $i['tgl']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Pj</label>
                            <input type="text" value="<?= $i['pj_order']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Jenis</label>
                            <input type="text" value="<?= $i['ket']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Barang</label>
                            <input type="text" value="<?= $i['produk']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Pj. Uang Keluar</label>
                            <input type="text" value="<?= $i['pj_uangkeluar']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Tgl. Uang Keluar</label>
                            <input type="text" value="<?= $i['tgl_uangkeluar']; ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Uang Keluar</label>
                            <input type="text" value="Rp <?= rupiah($i['uang_keluar']); ?>" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:12px;">Catatan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly><?= $i['catatan']; ?></textarea>
                        </div>
                        <img class="img-fluid" src="<?= base_url(); ?>/nota/<?= $i['nota_uangkeluar']; ?>" alt="Nota">
                        <div class="mt-2">
                            <a download="<?= $i['nota_uangkeluar']; ?>" href="<?= base_url(); ?>/nota/<?= $i['nota_uangkeluar']; ?>" title="<?= $i['nota_uangkeluar']; ?>" type="button" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="<?= base_url(); ?>/pengeluaran/edit" method="post">
                            <input type="hidden" name="id" value="<?= $i['id']; ?>">
                            <button type="submit" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                Edit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?= $this->endSection(); ?>
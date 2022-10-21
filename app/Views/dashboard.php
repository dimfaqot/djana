<?= $this->extend('templates/login'); ?>

<?= $this->section('content'); ?>

<?php
helper('functions');
// dd($data);
?>

<!-- DETAIL -->
<div class="container" style="margin-bottom: 20px;">
    <?php if (count($data) <= 0) : ?>
        <h6 class="text-center mb-3">Belum ada transaksi. <a href="<?= base_url(); ?>/produk">Belanja</a></h6>
        <?php die; ?>
    <?php endif; ?>
    <h1 class="text-center mb-3">TRANSAKSI</h1>
    <div class="mb-3 row">
        <label class="col-2 col-md-1 col-form-label">Tahun</label>
        <div class="col-5">
            <select class="form-select form-select-sm tahun" aria-label=".form-select-sm example">
                <option value="Semua">Semua</option>
                <?php foreach ($tahun as $i) : ?>
                    <?php if ($i == date('Y')) : ?>
                        <option selected value="<?= $i; ?>"><?= $i; ?></option>
                    <?php else : ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-2 col-md-1 col-form-label">Bulan</label>
        <div class="col-5">
            <select class="form-select form-select-sm bulan" aria-label=".form-select-sm example">
                <option value="Semua">Semua</option>
                <?php foreach ($bulan as $i) : ?>
                    <?php if ($i['angka'] == date('n')) : ?>
                        <option selected value="<?= $i['angka']; ?>"><?= $i['bulan']; ?></option>
                    <?php else : ?>
                        <option value="<?= $i['angka']; ?>"><?= $i['bulan']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-2 col-md-1 col-form-label">Transaksi</label>
        <div class="col-5">
            <select class="form-select form-select-sm progres" aria-label=".form-select-sm example">
                <option value="Semua">Semua</option>
                <?php foreach ($progres as $i) : ?>
                    <?php if ($i['text'] == 'Selesai') : ?>
                        <option selected value="<?= $i['text']; ?>"><?= $i['text']; ?></option>
                    <?php else : ?>
                        <option value="<?= $i['text']; ?>"><?= $i['text']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <canvas id="chart_transaksi" style="width:100%;"></canvas>
    <h6 class="mt-5 mb-3">TABEL DETAIL TRANSAKSI</h6>
    <table class="table table-sm mb-3" style="font-size:small">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tgl</th>
                <th class="d-none d-md-table-cell" scope="col">Pj Order</th>
                <th scope="col">Barang</th>
                <th class="d-none d-md-table-cell" scope="col">Qty</th>
                <th class="d-none d-md-table-cell">Keluar</th>
                <th class="d-none d-md-table-cell" scope="col">Pj</th>
                <th class="d-none d-md-table-cell">Masuk</th>
                <th class="d-none d-md-table-cell" scope="col">Teller</th>
                <th class="d-none d-md-table-cell" scope="col">Ket</th>
                <th scope="col">Laba</th>
            </tr>
        </thead>
        <tbody class="transaksi">

        </tbody>
    </table>
    <?php if (session('role') !== 'User') : ?>
        <div class="d-grid gap-2 d-flex justify-content-end mb-5 print">
        </div>
    <?php endif; ?>


    <h1 class="text-center mb-3">STATISTIK</h1>
    <div class="row mb-5">
        <div class="col-md-6">
            <canvas id="chart_pj_order" style="width:100%;"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chartOrder" style="width:100%;"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chart_pj_uangkeluar" style="width:100%;"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chart_penerima_uangmasuk" style="width:100%;"></canvas>
        </div>
    </div>

    <h1 class="text-center mb-3">TUGAS</h1>

    <div class="accordion accordion-flush mb-5" id="accordionFlushExample">
        <?php foreach (tugasNow() as $key => $i) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?= $key; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $key; ?>" aria-expanded="false" aria-controls="flush-collapse<?= $key; ?>">
                        <?= ucfirst($i['pj_order']); ?>
                    </button>
                </h2>
                <div id="flush-collapse<?= $key; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $key; ?>" data-bs-parent="#accordionFlushExample">
                    <table class="table table-sm mt-3" style="font-size:small;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tgl</th>
                                <th scope="col">Tugas</th>
                                <th scope="col">Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($i['data'] as $k => $d) : ?>
                                <tr>
                                    <th scope="row"><?= $k + 1; ?></th>
                                    <td><?= $d['tgl']; ?></td>
                                    <td><?= $d['produk']; ?></td>
                                    <td><?= $d['progres']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h1 class="text-center mb-3">ANAK PALING ALAY</h1>
    <div class="card">
        <div class="card-body text-center">
            <?php if (alay()['nama'] == 'Dim') : ?>
                <h3>-</h3>
            <?php else : ?>
                <h3><?= alay()['nama']; ?>. Keterlibatan hanya <?= alay()['keterlibatan']; ?> kali!</h3>

            <?php endif; ?>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>
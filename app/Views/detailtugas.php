<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<?php
helper('functions');
helper('form');
// dd($val);
?>

<!-- KERANJANG -->
<div class="container mb-3" style="margin-top:70px;">
    <?php if ($val === null) : ?>
        <div class="alert alert-danger" role="alert">
            Data tidak ditemukan!.
        </div>
    <?php else : ?>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div style="text-align:center; color:<?= ($data['progres'] == 'Menunggu' ? '#5DB661' : '#9E9E9E'); ?>">
                        <i style="font-size:20px;" class="fa fa-spinner"></i>
                        <p style="font-size:small">Menunggu</p>

                    </div>
                    <div>
                        -------
                    </div>
                    <div style="text-align:center; color:<?= ($data['progres'] == 'Proses' ? '#5DB661' : '#9E9E9E'); ?>">
                        <i style="font-size:20px;" class="fa fa-space-shuttle"></i>
                        <p style="font-size:small">Proses</p>

                    </div>
                    <div>
                        -------
                    </div>
                    <div style="text-align:center; color:<?= ($data['progres'] == 'Pembayaran' ? '#5DB661' : '#9E9E9E'); ?>">
                        <i style="font-size:20px;" class="fa fa-money"></i>
                        <p style="font-size:small">Pembayaran</p>

                    </div>
                    <div>
                        -------
                    </div>
                    <div style="text-align:center; color:<?= ($data['progres'] == 'Selesai' ? '#5DB661' : '#9E9E9E'); ?>">
                        <i style="font-size:20px;" class="fa fa-check-circle"></i>
                        <p style="font-size:small">Selesai</p>

                    </div>
                </div>
                <hr>
                <div class="card mb-3">
                    <div class="card-body text-center bg-info">
                        <h6>Harga</h6>
                        <h6 style="font-size:large">Rp <?= rupiah($data['jumlah']); ?></h6>
                    </div>
                </div>


                <?php if ($val !== false) : ?>
                    <?= form_open_multipart(base_url() . '/tugas/edit') ?>
                    <input type="hidden" value="<?= $data['id']; ?>" name="id">
                    <?php if (session('role') == 'Root' && session('role') == 'Admin' && session('role') == 'Bendahara') : ?>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Pj Order</span>
                            <select class="form-select" name="pj_order">
                                <?php foreach (djana() as $i) : ?>
                                    <?php if ($i['username'] == $data['pj_order']) : ?>
                                        <option value="<?= $i['username']; ?>" selected><?= firstWordUpCase($i['username']); ?></option>
                                    <?php else : ?>
                                        <option value="<?= $i['username']; ?>"><?= firstWordUpCase($i['username']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if (session('username') == $data['pj_order']) : ?>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Progres</span>
                            <select class="form-select" name="progres">
                                <?php foreach (progres() as $i) : ?>
                                    <?php if ($i['text'] !== 'Selesai') : ?>
                                        <?php if ($i['text'] == $data['progres']) : ?>
                                            <option value="<?= $i['text']; ?>" selected><?= firstWordUpCase($i['text']); ?></option>
                                        <?php else : ?>

                                            <option value="<?= $i['text']; ?>"><?= firstWordUpCase($i['text']); ?></option>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if (session('role') == 'Root' || session('role') == 'Bendahara') : ?>
                        <h6>Uang Keluar</h6>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Jml. Uang Keluar</span>
                            <input type="text" class="form-control" name="uang_keluar" value="<?= $data['uang_keluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Pj. Uang Keluar</span>
                            <select class="form-select" name="pj_uangkeluar">
                                <?php foreach (djana() as $i) : ?>
                                    <?php if ($i['username'] == $data['pj_uangkeluar']) : ?>
                                        <option value="<?= $i['username']; ?>" selected><?= firstWordUpCase($i['username']); ?></option>
                                    <?php else : ?>
                                        <option value="<?= $i['username']; ?>"><?= firstWordUpCase($i['username']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Ket. Uang Keluar</span>
                            <input type="text" class="form-control" placeholder="Ket. uang keluar" name="ket_uangkeluar" value="<?= $data['ket_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    <?php endif; ?>
                    <?php if (session('username') == $data['pj_uangkeluar']) : ?>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Nota. Uang Keluar</span>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#nota">

                                <div style="background-image:url('<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>'); width:100px;height:100px; background-size:cover; background-position:center;"></div>

                            </a>
                            <div class="input-group input-group-sm mt-3">
                                <input type="file" name="nota_uangkeluar" class="form-control">
                            </div>
                        </div>
                    <?php endif; ?>
                    <h6>Uang Masuk</h6>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width:160px;" class="input-group-text">Jml. Uang Masuk</span>
                        <input type="text" class="form-control" name="uang_masuk" value="<?= $data['uang_masuk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width:160px;" class="input-group-text">Ket. Uang Masuk</span>
                        <input type="text" class="form-control" name="ket_uangmasuk" value="<?= $data['ket_uangmasuk']; ?>" placeholder="Keterangan uang masuk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="d-grid gap-2 d-flex justify-content-end">
                        <a class="btn btn-sm btn-info" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Detail
                        </a>
                        <?php if ($data['progres'] !== 'Selesai' && session('role') !== 'Root') : ?>
                            <button class="btn btn-sm btn-primary me-md-2" type="submit">Save</button>
                        <?php endif; ?>
                        <?php if (session('role') == 'Root') : ?>
                            <button class="btn btn-sm btn-primary me-md-2" type="submit">Save</button>
                        <?php endif; ?>
                    </div>
                    </form>
                    <?php if (session('role') == 'Bendahara') : ?>
                        <?php if ($data['uang_masuk'] > 0 && $data['progres'] !== 'Selesai') : ?>
                            <form class="mt-3" method="POST" action="<?php base_url(); ?>/tugas/selesai">
                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                <input type="hidden" name="progres" value="Selesai">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-sm btn-success me-md-2" type="submit">Selesai</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (session('role') == 'Root') : ?>
                        <form class="mt-3" method="POST" action="<?php base_url(); ?>/tugas/selesai">
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            <input type="hidden" name="progres" value="Selesai">
                            <div class="d-grid gap-2">
                                <button class="btn btn-sm btn-success me-md-2" type="submit">Selesai</button>
                            </div>
                        </form>
                    <?php endif; ?>

                    <div class="collapse mt-3" id="collapseExample">
                        <div class="card card-body">
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">No. Nota</span>
                                <input type="text" class="form-control" name="no_nota" value="<?= $data['no_nota']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Tgl. Order</span>
                                <input type="text" class="form-control" value="<?= $data['tgl']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Penerima Order</span>
                                <input type="text" class="form-control" value="<?= $data['penerima_order']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Pj. Order</span>
                                <input type="text" class="form-control" value="<?= $data['pj_order']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Produk</span>
                                <input type="text" class="form-control" value="<?= $data['produk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Harga</span>
                                <input type="text" class="form-control" name="harga" value="Rp <?= rupiah($data['harga']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Qty</span>
                                <input type="text" class="form-control" value="<?= $data['qty']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Jumlah</span>
                                <input type="text" class="form-control" value="Rp <?= rupiah($data['jumlah']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Catatan Pembeli</span>
                                <input type="text" class="form-control" placeholder="Catatan dari pembeli" value="<?= $data['catatan']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Uang Modal</span>
                                <input type="text" class="form-control" name="uang_modal" value="Rp <?= rupiah($data['uang_modal']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Tgl. Uang Keluar</span>
                                <input type="text" class="form-control" name="tgl_uangkeluar" placeholder="Tanggal uang keluar" value="<?= $data['tgl_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Jml. Uang Keluar</span>
                                <input type="text" class="form-control" name="uang_keluar" value="Rp <?= rupiah($data['uang_keluar']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Ket. Uang Keluar</span>
                                <input type="text" class="form-control" placeholder="Ket. uang keluar" name="ket_uangkeluar" value="<?= $data['ket_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Pj. Uang Keluar</span>
                                <input type="text" class="form-control" name="pj_uangkeluar" value="<?= $data['pj_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Nota. Uang Keluar</span>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#nota">

                                    <div style="background-image:url('<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>'); width:100px;height:100px; background-size:cover; background-position:center;"></div>

                                </a>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Tgl. Uang Masuk</span>
                                <input type="text" class="form-control" name="tgl_uangmasuk" placeholder="Tanngal uang masuk" value="<?= $data['tgl_uangmasuk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Jml. Uang Masuk</span>
                                <input type="text" class="form-control" name="uang_masuk" value="Rp <?= rupiah($data['uang_masuk']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Penerima Uang Masuk</span>
                                <input type="text" class="form-control" name="penerima_uangmasuk" value="<?= $data['penerima_uangmasuk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Ket. Uang Masuk</span>
                                <input type="text" class="form-control" name="ket_uangmasuk" value="<?= $data['ket_uangmasuk']; ?>" placeholder="Keterangan uang masuk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Tgl. Selesai</span>
                                <input type="text" class="form-control" name="ket_uangmasuk" value="<?= $data['tgl_diterimabendahara']; ?>" placeholder="Selesai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span style="width:160px;" class="input-group-text">Keterangan</span>
                                <input type="text" class="form-control" name="ket" value="<?= $data['ket']; ?>" placeholder="Selesai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>

                        </div>
                    </div>
                    <!-- false -->
                <?php else : ?>
                    <div class="card card-body">
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">No. Nota</span>
                            <input type="text" class="form-control" name="no_nota" value="<?= $data['no_nota']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Tgl. Order</span>
                            <input type="text" class="form-control" value="<?= $data['tgl']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Penerima Order</span>
                            <input type="text" class="form-control" value="<?= $data['penerima_order']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Pj. Order</span>
                            <input type="text" class="form-control" value="<?= $data['pj_order']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Produk</span>
                            <input type="text" class="form-control" value="<?= $data['produk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Harga</span>
                            <input type="text" class="form-control" name="harga" value="Rp <?= rupiah($data['harga']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Qty</span>
                            <input type="text" class="form-control" value="<?= $data['qty']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Jumlah</span>
                            <input type="text" class="form-control" value="Rp <?= rupiah($data['jumlah']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Catatan Pembeli</span>
                            <input type="text" class="form-control" placeholder="Catatan dari pembeli" value="<?= $data['catatan']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Uang Modal</span>
                            <input type="text" class="form-control" name="uang_modal" value="Rp <?= rupiah($data['uang_modal']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Tgl. Uang Keluar</span>
                            <input type="text" class="form-control" name="tgl_uangkeluar" placeholder="Tanggal uang keluar" value="<?= $data['tgl_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Jml. Uang Keluar</span>
                            <input type="text" class="form-control" name="uang_keluar" value="Rp <?= rupiah($data['uang_keluar']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Ket. Uang Keluar</span>
                            <input type="text" class="form-control" placeholder="Ket. uang keluar" name="ket_uangkeluar" value="<?= $data['ket_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Pj. Uang Keluar</span>
                            <input type="text" class="form-control" name="pj_uangkeluar" value="<?= $data['pj_uangkeluar']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Nota. Uang Keluar</span>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#nota">

                                <div style="background-image:url('<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>'); width:100px;height:100px; background-size:cover; background-position:center;"></div>

                            </a>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Tgl. Uang Masuk</span>
                            <input type="text" class="form-control" name="tgl_uangmasuk" placeholder="Tanngal uang masuk" value="<?= $data['tgl_uangmasuk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Jml. Uang Masuk</span>
                            <input type="text" class="form-control" name="uang_masuk" value="Rp <?= rupiah($data['uang_masuk']); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Penerima Uang Masuk</span>
                            <input type="text" class="form-control" name="penerima_uangmasuk" value="<?= $data['penerima_uangmasuk']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Ket. Uang Masuk</span>
                            <input type="text" class="form-control" name="ket_uangmasuk" value="<?= $data['ket_uangmasuk']; ?>" placeholder="Keterangan uang masuk" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Tgl. Selesai</span>
                            <input type="text" class="form-control" name="ket_uangmasuk" value="<?= $data['tgl_diterimabendahara']; ?>" placeholder="Selesai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width:160px;" class="input-group-text">Keterangan</span>
                            <input type="text" class="form-control" name="ket" value="<?= $data['ket']; ?>" placeholder="Selesai" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                        </div>

                    </div>
                <?php endif; ?>


            </div>
        </div>
    <?php endif; ?>
</div>


<!-- modal -->
<?php if ($data !== null) : ?>
    <div class="modal fade" id="nota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Nota uang keluar <?= $data['produk']; ?></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img class="img-fluid" src="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" alt="Nota">
                </div>
                <div class="modal-footer">
                    <a download="<?= $data['nota_uangkeluar']; ?>" href="<?= base_url(); ?>/nota/<?= $data['nota_uangkeluar']; ?>" title="<?= $data['nota_uangkeluar']; ?>" type="button" class="btn btn-sm btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection(); ?>
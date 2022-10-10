<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>

<!-- DETAIL PESAN MESSAGE -->
<div class="fixed-top bg-light" style="top:55px;height: 100px;">
    <div class="container">
        <div class="card mb-1">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" aria-label="Sizing example input" placeholder="Tulis pesan" aria-describedby="inputGroup-sizing-sm">
            <button class="btn btn-success" type="button"><i class="fa fa-paper-plane-o"></i></button>
        </div>

    </div>
</div>
<div class="container" style="margin-top:160px;">
    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <div class="row gap-1 mb-1">
                    <div class="col-5 col-md-2">
                        <div style="font-size:small; border-radius:0px 0px 20px 0px;">
                            <a href="#">
                                <div style="background-image:url('<?= base_url(); ?>/images/l.jpeg'); height: 150px;  background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 5px; border: 1px solid green;"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-md-7">
                        <h6 style="font-weight:normal;">Some quick example text to build</h6>
                        <h6>Rp 50.000</h6>
                        <h6><i class="fa fa-shopping-bag" style="color:rgb(29, 158, 65)"></i> Djana</h6>
                        <div class="d-flex gap-2">
                            <a style="text-decoration:none; font-size:small; color:rgb(69, 69, 69);" href=""><i class="fa fa-shopping-basket"></i> Keranjang</a>
                            <a style="text-decoration:none; font-size:small; color:rgb(69, 69, 69);" href=""><i class="fa fa-truck"></i> Beli</a>
                        </div>
                    </div>
                </div>
                <p style="font-size:x-small">17 Agustus 2020</p>
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-start mb-1">
                    <div style="background-color:aliceblue; font-size:small; border-radius:0px 0px 20px 0px; padding:15px;max-width:90%">Ready?</div>
                </div>
                <p style="font-size:x-small">17 Agustus 2020</p>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-end mb-1">
                    <div style="background-color:aquamarine; font-size:small; border-radius:0px 0px 0px 20px; padding:15px; max-width: 90%;">Lorem ipsum dolor sit. Lorem ipsum ullam cum excepturi, distinctio vero sapiente voluptates tempore asperiores eligendi quam, et explicabo? Conseq</div>
                </div>
                <p style="font-size:x-small;text-align:right;">17 Agustus 2020</p>
            </div>



        </div>
    </div>
</div>



<?= $this->endSection(); ?>
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<!-- PESAN MESSAGE -->
<div class="container" style="margin-top: 70px;">
    <div class="list-group">
        <a href="<?= base_url(); ?>/pesan/detailpesan" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex gap-3">
                <div style="background-image:url('<?= base_url(); ?>/images/<?= session('image'); ?>'); border:1px solid darkgrey; height: 50px; width: 50px; background-position: center; background-repeat: no-repeat; background-size: cover; border-radius: 50%;"></div>
                <div>
                    <h6 class="mb-1">List group item heading</h6>
                    <small class="mb-1">Some placeholder content in a paragraph.</small>

                </div>
                <div class="ms-auto">
                    <small>3 days ago</small>
                </div>
            </div>
        </a>
    </div>
</div>



<?= $this->endSection(); ?>
<?= $this->extend('templates/pesan'); ?>

<?= $this->section('content'); ?>
<!-- DETAIL -->

<?php

?>

<div class="container p-2" style="margin-top:70px;">
    <form method="post" action="<?= base_url(); ?>/user/save">

        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Alias</span>
            <input type="text" name="alias" class="form-control" placeholder="Alias" value="<?= $data['alias']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
        </div>

        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Password Baru</span>
            <input type="text" name="password" class="form-control" placeholder="Password Baru" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-sm btn-primary">
                Save
            </button>
        </div>
    </form>
    <?php if (session('role') !== 'User' && session('role') !== 'Guest') : ?>
        <hr>
        <h5>Tambah User Baru</h5>

        <form method="post" action="<?= base_url(); ?>/user">
            <div class="input-group input-group-sm mb-3">
                <span style="width:150px;" class="input-group-text">Username</span>
                <input type="text" name="username" class="form-control" placeholder="Username" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
            <div class="input-group input-group-sm mb-3">
                <span style="width:150px;" class="input-group-text">Nama</span>
                <input type="text" name="nama" class="form-control" placeholder="Nama" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <span style="width:150px;" class="input-group-text">Alias</span>
                <input type="text" name="alias" class="form-control" placeholder="Alias" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <span style="width:150px;" class="input-group-text">Sub</span>
                <input type="text" name="sub" class="form-control" placeholder="contoh: SMA" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <div class="input-group input-group-sm mb-3">
                <span style="width:150px;" class="input-group-text">Password</span>
                <input type="text" name="password" class="form-control" placeholder="Password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>

            <?php if (session('role') == 'Root') : ?>
                <div class="input-group input-group-sm mb-3">
                    <label style="width:150px;" class="input-group-text">Role</label>
                    <select class="form-select" name="role">
                        <option>-Pilih Role-</option>
                        <?php foreach ($role as $i) : ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-sm btn-primary">
                    Save
                </button>
            </div>
        </form>
    <?php endif; ?>

    <?php if (session('role') == 'Root') : ?>
        <hr>
        <h5>Edit User</h5>
        <div class="input-group input-group-sm mb-3">
            <span style="width:150px;" class="input-group-text">Cari User</span>
            <input type="text" class="form-control cariuser" placeholder="..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <a class="btn btn-outline-secondary" href="<?= base_url(); ?>/user" type="button"><i class="fa fa-trash"></i></a>
        </div>
        <div class="list-group bodycariuser" style="margin-left:152px;width:70%; position:absolute;z-index:28">

        </div>

        <?php if ($search) : ?>
            <form method="post" action="<?= base_url(); ?>/user/edituser">
                <input type="hidden" name="id" value="<?= $search['id']; ?>">
                <div class="input-group input-group-sm mb-3">
                    <span style="width:150px;" class="input-group-text">Username</span>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $search['username']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span style="width:150px;" class="input-group-text">Nama</span>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $search['nama']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <span style="width:150px;" class="input-group-text">Alias</span>
                    <input type="text" name="alias" class="form-control" placeholder="Alias" value="<?= $search['alias']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <span style="width:150px;" class="input-group-text">Sub</span>
                    <input type="text" name="sub" class="form-control" placeholder="contoh: SMA" value="<?= $search['sub']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>

                <div class="input-group input-group-sm mb-3">
                    <span style="width:150px;" class="input-group-text">Password Baru</span>
                    <input type="text" name="password" class="form-control" placeholder="Password baru" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <?php if (session('role') == 'Root') : ?>
                    <div class="input-group input-group-sm mb-3">
                        <label style="width:150px;" class="input-group-text">Role</label>
                        <select class="form-select" name="role">
                            <?php foreach ($role as $i) : ?>
                                <?php if ($search['role'] == $i) : ?>

                                    <option value="<?= $i; ?>" selected><?= $i; ?></option>
                                <?php else : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>

                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Save
                    </button>
                </div>
            </form>
        <?php endif; ?>
    <?php endif; ?>

</div>


<?= $this->endSection(); ?>
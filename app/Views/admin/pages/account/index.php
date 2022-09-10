<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Complaint
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<section class="row">
    <div class="col-6">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Ubah Password</div>
            <div class="card-body">
                <?php if ($errors = session()->getFlashdata('errors')): ?>
                    <div class="alert-danger alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif ($success = session()->getFlashdata('success')): ?>
                    <div class="alert-success alert text-left">
                        <ul>
                            <li><?= $success; ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="<?= route_to('admin.accounts.password.update'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="PUT" name="_method">
                    <div class="mb-3">
                        <label class="small mb-1" for="old_password">Password lama</label>
                        <input class="form-control" id="old_password" name="old_password" type="password" placeholder="Masukkan password lama">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="new_password">Password baru</label>
                        <input class="form-control" id="new_password" name="new_password" type="password" placeholder="Masukkan password baru">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="repeat_new_password">Ulangi password baru</label>
                        <input class="form-control" id="repeat_new_password" name="repeat_new_password" type="password" placeholder="Ulangi masukkan password baru">
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

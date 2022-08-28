<div class="row">
    <div class="col-12">
        <form action="<?= route_to('anonymous.applicants.store'); ?>" class="bg-white contact-form" method="post">
            <?= csrf_field(); ?>

            <?php if ($success = session()->getFlashdata('rent-success')): ?>
                <div class="alert-success alert text-left">
                    <ul>
                        <li><?= $success; ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Nama ..">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email ..">
            </div>
            <div class="form-group">
                <input type="text" name="job" class="form-control" placeholder="Pekerjaan ..">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="No Telp ..">
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control" placeholder="Alamat ..">
            </div>
            <div class="form-group">
                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Pesan .."></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Kirim" class="btn btn-primary py-2 px-4">
            </div>
        </form>

    </div>
</div>
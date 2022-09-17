<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="<?= route_to('anonymous.index'); ?>"><img src="<?= base_url('/assets/images/logoPB.png'); ?>" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Ganti Password</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                <?php if ($errors = session()->getFlashdata('errors')) : ?>
                    <div class="alert-danger alert text-left">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
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

                <form action="<?= route_to('auth.password.store'); ?>?<?= http_build_query($_GET); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Repeat Password" name="repeat_password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ganti Password</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
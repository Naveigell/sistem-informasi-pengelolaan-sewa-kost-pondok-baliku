<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="<?= route_to('anonymous.index'); ?>"><img src="<?= base_url('/assets/images/logoPB.png'); ?>" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Sign Up</h1>
                <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

                <form action="<?= route_to('register.store'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                        <div class="alert-danger alert text-left">
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

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="name" placeholder="Nama">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="username" placeholder="Username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="email" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl" name="phone" placeholder="Nomor HP">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Already have an account? <a href="<?= base_url('/login'); ?>" class="font-bold">Log
                            in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="<?= route_to('anonymous.index'); ?>"><img src="<?= base_url(); ?>/assets/images/logoPB.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

            <?php if ($errors = session()->getFlashdata('errors')): ?>
                <div class="alert-danger alert text-left">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('/login'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
<!--            <div class="text-center mt-5 text-lg fs-4">-->
<!--                <p class="text-gray-600">Don't have an account? <a href="--><?//= base_url('/register'); ?><!--" class="font-bold">Sign-->
<!--                        up</a>.</p>-->
<!--                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>-->
<!--            </div>-->
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
<?= $this->endSection(); ?>

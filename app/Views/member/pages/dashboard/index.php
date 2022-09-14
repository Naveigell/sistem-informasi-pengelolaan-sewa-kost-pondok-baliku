<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<section class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldActivity"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Komplain Aktif</h6>
                                <h6 class="font-extrabold mb-0"><?= $compaintCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Pembayaran Bulan Ini</h6>
                                <?php if (!$payment && date('j') < 10) : ?>
                                    <h6 class="mb-0 text text-warning">Silakan melakukan pembayaran sebelum tanggal 10</h6>
                                <?php elseif (!$payment) : ?>
                                    <h6 class="mb-0 text text-danger">Belum lunas</h6>
                                <?php else : ?>
                                    <h6 class="mb-0 text text-success">Lunas</h6>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12"> </div>
        </div>
        <div class="row">
            <!-- Hoverable rows start -->
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">

                    </div>
                </div>
            </section>
            <!-- Hoverable rows end -->
            <div class="col-12 col-xl-4">

            </div>
            <div class="col-12 col-xl-8">

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
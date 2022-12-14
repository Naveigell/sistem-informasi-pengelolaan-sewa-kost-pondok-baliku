<?= $this->extend('layouts/admin/admin') ?>

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
                                <div class="stats-icon yellow" style="background-color: #f3ec25;">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Calon Penghuni Belum Diverifikasi</h6>
                                <h6 class="font-extrabold mb-0"><?= $applicantCount; ?></h6>
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
                                <div class="stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Penghuni Yang Belum Membayar Bulan Ini</h6>
                                <h6 class="font-extrabold mb-0"><?= $activeMemberCount; ?></h6>
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
                                <div class="stats-icon red">
                                    <i class="iconly-boldDanger"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Jumlah Kamar Kos Yang Tersedia</h6>
                                <h6 class="font-extrabold mb-0"><?= $emptyRoomCount; ?></h6>
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
                                <div class="stats-icon green" style="background-color: #eae355;">
                                    <i class="iconly-boldPaper"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Komplain Yang Belum di Selesaikan</h6>
                                <h6 class="font-extrabold mb-0"><?= $complaintCount; ?></h6>
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
                                <h6 class="text-muted font-semibold">Pembayaran Belum Diverifikasi</h6>
                                <h6 class="font-extrabold mb-0"><?= $unverifiedPaymentCount; ?></h6>
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
        </div>
    </div>

</section>

<?= $this->endSection() ?>
<?= $this->extend('layouts/applicant/applicant') ?>

<?= $this->section('content-title') ?>
    Payment
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <?php
    /**
     * @var $bookingId
     * @var $booking
     * @var $roomType
     * @var $facilities
     */
    ?>

    <section class="row">
        <div class="col-12">
            <div class="row">

                <section class="section">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Silahkan membayar pesanan anda</h5>
                                </div>
                                <form class="card-body form-group" method="post" action="<?= route_to('applicant.payments.store', $bookingId); ?>" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <?php if ($errors = session()->getFlashdata('errors')): ?>
                                        <div class="alert-danger alert text-left">
                                            <ul>
                                                <?php foreach ($errors as $error): ?>
                                                    <li><?= $error; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-row row">
                                        <div class="form-group col-6">
                                            <label for="inputEmail4">Tipe Kamar</label>
                                            <input type="text" class="form-control" placeholder="Tipe Kamar" value="<?= $roomType['name']; ?>" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputPassword4">Total Pembayaran</label>
                                            <input type="text" class="form-control" value="<?= format_currency($booking['total']); ?>" placeholder="Total Pembayaran" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputPassword4">Fasilitas pilihan</label>
                                            <ul class="list-group mt-3">
                                                <?php foreach ($facilities as $facility): ?>
                                                    <li class="list-group-item">
                                                        <label for="room-facility-1"><?= $facility['facility_name']; ?></label>
                                                        <label style="float: right;" class="d-inline-block badge badge-success"><?= format_currency($facility['facility_price']); ?></label>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputPassword4">Input Bukti Pembayaran</label>
                                            <input type="file" class="form-control" value="" placeholder="Total Pembayaran" name="proof" accept="image/jpeg,image/png,image/jpg">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="list-group-icons">
                    <div class="row match-height">
                        <div class="col-lg-6 col-md-12">

                        </div>
                    </div>
                </section>
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
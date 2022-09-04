<?php

use App\Models\ApplicantFacility;
use App\Models\RoomFacility;

?>
<?= $this->extend('layouts/applicant/applicant') ?>

<?= $this->section('content-title') ?>
    Payment
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <?php /** @var array $bookings */ ?>

    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pelamar Kos</h4>
                </div>
                <div class="card-content">
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Tipe Kamar</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Pesan (Optional)</th>
                                <th>Fasilitas</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>

                                    <?php
                                        $roomType          = (new \App\Models\RoomType())->where('id', $booking['room_type_id'])->first();
                                        $requestFacilities = (new ApplicantFacility())->where('applicant_request_room_id', $booking['id'])->findAll();
                                        $payment           = (new \App\Models\ApplicantRequestRoomPayment())->where('room_id', $booking['id'])->first();

                                        $facilities        = [];

                                        if (count($requestFacilities) > 0) {

                                            $ids = array_map(function ($facility) {
                                                return $facility['room_facility_id'];
                                            }, $requestFacilities);

                                            $facilities = (new RoomFacility())->whereIn('id', $ids)->findAll();
                                        }
                                    ?>

                                    <tr>
                                        <td><?= $roomType['name']; ?></td>
                                        <td><?= date('d F Y', strtotime($booking['booking_date'])); ?></td>
                                        <td><?= $booking['message'] ?: '-'; ?></td>
                                        <td><?= join(', ', array_column($facilities, 'facility_name')); ?></td>
                                        <td><?= format_currency($booking['total']); ?></td>
                                        <td>
                                            <?php if (!$payment): ?>
                                                <a href="<?= route_to('applicant.payments.create', $booking['id']); ?>" class="btn btn-sm btn-primary">Bayar</a>
                                            <?php elseif ($payment['status'] == \App\Models\ApplicantRequestRoomPayment::STATUS_UNVERIFIED): ?>
                                                <span class="badge badge-danger bg-warning">Menunggu verifikasi</span>
                                            <?php elseif ($payment['status'] == \App\Models\ApplicantRequestRoomPayment::STATUS_REJECTED): ?>
                                                <span class="badge badge-danger bg-danger">Ditolak</span>
                                            <?php elseif ($payment['status'] == \App\Models\ApplicantRequestRoomPayment::STATUS_PAID_OFF): ?>
                                                <span class="badge badge-danger bg-success">Lunas</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
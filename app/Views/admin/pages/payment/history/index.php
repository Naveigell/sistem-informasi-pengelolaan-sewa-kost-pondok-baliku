<?php

use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomUserPivot;

?>
<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Payment
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<?php /** @var array $payments */ ?>
<?php /** @var array $room */ ?>
<?php /** @var array $roomType */ ?>
<?php /** @var array $facilities */ ?>

<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-8">
                    <h4 class="card-title">Histori Pembayaran</h4>
                </div>
            </div>
            <!-- table bordered -->
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>Nomor Kamar</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Total Bayar</th>
                        <th>Bukti Pembayaran</th>
                        <th>Tipe Kamar</th>
                        <th>Fasilitas</th>
                        <th>Metode Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>

                            <?php
                                $roomUserPivot = (new RoomUserPivot())->where('user_id', $payment['user_id'])->orderBy('id', 'DESC')->first();
                                $room          = (new Room())->where('id', $roomUserPivot['room_id'])->orderBy('id', 'DESC')->first();
                                $roomType      = (new RoomType())->where('id', $room['room_type_id'])->first();

                                $duration   = (new \App\Models\RoomRentDuration())->where('id', $room['room_rent_duration_id'])->first();
                                $facilities = (new \App\Models\RoomFacilityPivot())->withFacilities()->where('room_id', $room['id'])->findAll();

                                $activeFacilities = array_filter($facilities, function ($facility) {
                                    return $facility['is_active'];
                                });
                            ?>

                            <tr>
                                <td><?= $room['room_number']; ?></td>
                                <td class="text-bold-500"><?= date('d F Y', strtotime($payment['payment_date'])); ?></td>
                                <td><?= format_currency($room['price']); ?></td>
                                <td><img src="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>" alt="" style="width: 150px; height: 150px;"></td>
                                <td><?= $roomType['name'] ?: '-'; ?></td>
                                <td><?= join(', ', array_column($activeFacilities, 'facility_name')); ?></td>
                                <td><?= ucwords($payment['payment_type']); ?></td>
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
</section>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>

<?= $this->endSection() ?>

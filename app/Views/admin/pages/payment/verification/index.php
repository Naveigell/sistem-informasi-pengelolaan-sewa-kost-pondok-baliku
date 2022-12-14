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
                        <th>Metode Pembayaran</th>
                        <th>Deskripsi Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($payments as $payment): ?>

                        <?php
                            $roomUserPivot = (new RoomUserPivot())->where('user_id', $payment['user_id'])->orderBy('id', 'DESC')->first();
                            $room          = (new Room())->where('id', $roomUserPivot['room_id'])->orderBy('id', 'DESC')->first();
                            $roomType      = (new RoomType())->where('id', $room['room_type_id'])->first();

                            $roomFacilityPivot = (new \App\Models\RoomFacilityPivot())->where('room_id', $room['id'])->where('is_active', 1)->findAll();
                            $facilityIds       = array_column($roomFacilityPivot, 'facility_id');

                            $facilities        = [];
                            $total             = 0;

                            if (count($facilityIds) > 0) {
                                $facilities = (new \App\Models\RoomFacility())->whereIn('id', $facilityIds)->findAll();

                                $total = array_sum(
                                    array_column($facilities, 'facility_price')
                                );
                            }
                        ?>

                        <tr>
                            <td><?= $room['room_number']; ?></td>
                            <td class="text-bold-500"><?= date('d F Y', strtotime($payment['payment_date'])); ?></td>
                            <td><?= format_currency($room['price'] + $total); ?></td>
                            <td>
                                <a href="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>"
                                   class="image-zoom">
                                    <img src="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>" alt="" style="width: 150px; height: 150px;">
                                </a>
                            </td>
                            <td><?= ucwords($payment['payment_type']); ?></td>
                            <td><?= $payment['description'] ?: '-'; ?></td>
                            <td>
                                <form method="post" action="<?= route_to('admin.payments.verifications.update', $payment['id']); ?>" id="form-payment-<?= $payment['id']; ?>">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" value="PUT" name="_method">
                                    <input type="hidden" value="" name="reply" id="form-payment-reply-<?= $payment['id']; ?>">
                                    <input type="hidden" value="" id="form-payment-status-<?= $payment['id']; ?>" name="status">
                                    <button type="button" data-payment-id="<?= $payment['id']; ?>" name="status" class="btn-approve btn btn-sm icon icon-left btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Terima</button>
                                    <button type="button" data-payment-id="<?= $payment['id']; ?>" name="status" class="btn-reject btn btn-sm icon icon-left btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Tolak</button>
                                </form>
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
</section>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
<script>
    $('.btn-approve').on('click', function () {
        var paymentId = $(this).data('payment-id');

        process(paymentId, 1);
    });

    $('.btn-reject').on('click', function () {
        var paymentId = $(this).data('payment-id');

        process(paymentId, 0);
    });

    function process(paymentId, status) {
        var reply = $('#form-payment-reply-' + paymentId);

        $('#form-payment-status-' + paymentId).val(status);

        Swal.fire({
            title: 'Yakin ' + (status === 1 ? 'selesai' : 'tolak') + ' ?',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
            },
            inputLabel: 'Ketik balasan disini',
            confirmButtonText: 'Simpan',
        }).then(function (result) {
            if (result.isConfirmed) {
                reply.val(result.value);
                $('#form-payment-' + paymentId).submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>

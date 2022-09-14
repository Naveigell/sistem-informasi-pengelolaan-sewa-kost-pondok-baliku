<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Calon Penghuni
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Calon Penghuni Kos</h4>
                </div>
                <div class="card-content">
                    <!-- table hover -->
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe Kamar</th>
                                <th>Fasilitas</th>
                                <th>Foto KTP</th>
                                <th>Bukti Pembayaran</th>
                                <th>Total Bayar</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /** @var array $bookings */
                            foreach ($bookings as $booking): ?>

                                <?php
                                    $user              = (new \App\Models\User())->where('id', $booking['user_id'])->first();
                                    $biodata           = (new \App\Models\Biodata())->where('user_id', $user['id'])->first();
                                    $roomType          = (new \App\Models\RoomType())->where('id', $booking['room_type_id'])->first();
                                    $payment           = (new \App\Models\ApplicantRequestRoomPayment())->where('room_id', $booking['id'])->first();
                                    $requestFacilities = (new \App\Models\ApplicantFacility())->where('applicant_request_room_id', $booking['id'])->findAll();

                                    $facilities        = [];

                                    if (!$payment) {
                                        continue;
                                    }

                                    if (count($requestFacilities) > 0) {

                                        $ids = array_map(function ($facility) {
                                            return $facility['room_facility_id'];
                                        }, $requestFacilities);

                                        $facilities = (new \App\Models\RoomFacility())->whereIn('id', $ids)->findAll();
                                    }
                                ?>

                                <tr>
                                    <td class="text-bold-500"><?= $user['name']; ?></td>
                                    <td><?= $roomType['name']; ?></td>
                                    <td><?= join(', ', array_column($facilities, 'facility_name')); ?></td>
                                    <td>
                                        <a href="<?= base_url('uploads/images/occupants') . DIRECTORY_SEPARATOR . $biodata['identity_card']; ?>" class="image-zoom">
                                            <img src="<?= base_url('uploads/images/occupants') . DIRECTORY_SEPARATOR . $biodata['identity_card']; ?>" alt="" style="width: 150px; height: 150px;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>"
                                           class="image-zoom">
                                            <img src="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>" alt="" style="width: 150px; height: 150px;">
                                        </a>
                                    </td>
                                    <td style="white-space: initial;"><?= format_currency($booking['total']); ?></td>
                                    <td style="white-space: initial;"><?= $booking['message'] ?: '-'; ?></td>
                                    <td>
                                        <?php if ($payment && $payment['status'] == \App\Models\ApplicantRequestRoomPayment::STATUS_UNVERIFIED): ?>
                                            <button type="button" class="btn-confirmation btn btn-sm btn-outline-primary block" data-booking-id="<?= $booking['id']; ?>">
                                                Konfirmasi
                                            </button>
                                            <button type="button" class="btn-reject btn btn-sm btn-outline-danger block" data-booking-id="<?= $booking['id']; ?>">
                                                Tolak
                                            </button>
                                            <form method="post" action="<?= route_to('admin.applicants.approve', $booking['id']); ?>" class="d-none" id="form-approve-<?= $booking['id']; ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="PUT" name="_method">
                                            </form>
                                            <form method="post" action="<?= route_to('admin.applicants.reject', $booking['id']); ?>" class="d-none" id="form-reject-<?= $booking['id']; ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="PUT" name="_method">
                                            </form>
                                        <?php elseif ($payment['status'] == \App\Models\ApplicantRequestRoomPayment::STATUS_PAID_OFF): ?>
                                            <span class="badge bg-success">Diterima</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
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

<?= $this->section('content-script') ?>

<?php if ($failed = session()->get('failed')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $failed; ?>',
        })
    </script>
<?php endif; ?>

    <script>
        $('.btn-confirmation').on('click', function () {

            var id   = $(this).data('booking-id');
            var form = $('#form-approve-' + id);

            Swal.fire({
                title: 'Konfirmasi?',
                text: "Klik diluar modal untuk membatalkan",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $('.btn-reject').on('click', function () {

            var id   = $(this).data('booking-id');
            var form = $('#form-reject-' + id);

            Swal.fire({
                title: 'Tolak?',
                text: "Klik diluar modal untuk membatalkan",
                icon: 'warning',
                confirmButtonColor: '#d6303e',
                confirmButtonText: 'Ya, tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
<?= $this->endSection() ?>

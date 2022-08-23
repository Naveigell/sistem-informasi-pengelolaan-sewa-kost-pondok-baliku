<?php

use App\Models\Room;
use App\Models\RoomUserPivot;

?>
<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Complaint
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<?php /** @var array $complaints */ ?>
<?php /** @var array $roomUserPivot */ ?>
<?php /** @var array $room */ ?>
<?php /** @var array $roomType */ ?>

<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-8">
                    <h4 class="card-title">Histori Komplain Fasilitas</h4>
                </div>
            </div>
            <!-- table bordered -->
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                    <tr>
                        <th>No Kamar</th>
                        <th>Tanggal Keluhan</th>
                        <th>Pesan Keluhan</th>
                        <th>Nama Penghuni</th>
                        <th>Gambar Lampiran</th>
                        <th>Status Keluhan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($complaints as $complaint): ?>

                        <?php
                            $user          = (new \App\Models\User())->where('id', $complaint['user_id'])->first();
                            $roomUserPivot = (new RoomUserPivot())->where('user_id', $user['id'])->orderBy('id', 'DESC')->first();
                            $room          = (new Room())->where('id', $roomUserPivot['room_id'])->orderBy('id', 'DESC')->first();
                        ?>

                        <tr>
                            <td class="text-bold-100"><?= $room['room_number']; ?></td>
                            <td><?= date('d/m/Y', strtotime($complaint['complaint_date'])); ?></td>
                            <td class="text-bold-100"><?= $complaint['description'] ?: '-'; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td>
                                <a href="<?= base_url('uploads/images/complaints') . DIRECTORY_SEPARATOR . $complaint['proof']; ?>" class="image-zoom">
                                    <img src="<?= base_url('uploads/images/complaints') . DIRECTORY_SEPARATOR . $complaint['proof']; ?>" alt="" style="width: 150px; height: 150px;">
                                </a>
                            </td>
                            <td>
                                <?php if ($complaint['status'] == \App\Models\Complaint::STATUS_FINISHED): ?>
                                    -
                                <?php else: ?>
                                    <form method="post" action="<?= route_to('admin.complaints.update', $complaint['id']); ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" value="PUT" name="_method">
                                        <button type="submit" class="btn-sm btn icon icon-left btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Selesai </button>
                                    </form>
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
</section>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
<script>
    $('.btn-add').on('click', function () {
        var description  = $('#description');
        var proof        = $('#proof');

        var form = new FormData();
        form.append('room_id', '<?= $room["id"]; ?>');
        form.append('description', description.val());
        form.append('proof', proof[0].files.length > 0 ? proof[0].files[0] : null);

        $.ajax({
            url: '<?= route_to("admin.complaints.store"); ?>',
            type: 'POST',
            data: form,
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.reload();
            },
            error: function (response) {
                render_errors($("#error-messages"), JSON.parse(response.responseText));
            }
        });
    })
</script>
<?= $this->endSection() ?>

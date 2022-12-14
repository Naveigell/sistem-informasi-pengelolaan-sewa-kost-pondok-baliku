<?= $this->extend('layouts/member/member') ?>

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
                <div class="col-sm-2">
                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                        Tambahkan Data
                    </button>
                </div>
                <!-- Vertically Centered modal Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Form Komplain
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <section id="multiple-column-form">
                                    <div class="row match-height">
                                        <div class="col-19">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form class="form">
                                                            <div class="row">
                                                                <div class="col-md-12 col-12 d-none alert alert-danger" id="error-messages"></div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="disabledInput">Nomor Kamar</label>
                                                                        <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= $room['room_number']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="disabledInput">Nama Penghuni</label>
                                                                        <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= session()->get('user')->name; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="disabledInput">Tipe Kamar</label>
                                                                        <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= $roomType['name']; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="description">Keterangan</label>
                                                                        <input type="text" id="description" class="form-control" name="description" placeholder="Deskripsi keluhan">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="payment_date">Tanggal Pembayaran</label>
                                                                        <input type="text" id="payment_date" class="form-control" name="payment_date" placeholder="Tanggal Pembayaran" readonly value="<?= date('d F Y'); ?>">
<!--                                                                        <input type="month" id="payment_date" class="form-control" name="payment_date" placeholder="Tanggal Pembayaran">-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="mb-3">
                                                                        <label for="proof" class="form-label">Unggah Lampiran</label>
                                                                        <input accept="image/jpeg,image/png,image/jpg" class="form-control" type="file" id="proof">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="button" class="btn btn-primary ml-1 btn-add">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Accept</span>
                                </button>
                            </div>
                        </div>
                    </div>
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
                            <th>Balasan Admin</th>
                            <th>Nama Penghuni</th>
                            <th>Gambar Lampiran</th>
                            <th>Status Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($complaints as $complaint): ?>
                            <tr>
                                <td class="text-bold-100"><?= $room['room_number']; ?></td>
                                <td><?= date('d/m/Y', strtotime($complaint['complaint_date'])); ?></td>
                                <td class="text-bold-100"><?= $complaint['description'] ?: '-'; ?></td>
                                <td><?= $complaint['reply'] ?? '-'; ?></td>
                                <td><?= session()->get('user')->name; ?></td>
                                <td>
                                    <a href="<?= base_url('uploads/images/complaints') . DIRECTORY_SEPARATOR . $complaint['proof']; ?>" class="image-zoom">
                                        <img src="<?= base_url('uploads/images/complaints') . DIRECTORY_SEPARATOR . $complaint['proof']; ?>" alt="" style="width: 150px; height: 150px;">
                                    </a>
                                </td>
                                <td>
                                    <?php if ($complaint['status'] == \App\Models\Complaint::STATUS_FINISHED): ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php elseif ($complaint['status'] == \App\Models\Complaint::STATUS_REJECTED): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Sedang Di Proses</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ((is_null($complaint['approved_by_member']) || $complaint['approved_by_member'] == 0) && $complaint['status'] == \App\Models\Complaint::STATUS_FINISHED): ?>
                                        <form method="post" action="<?= route_to('member.complaints.update', $complaint['id']); ?>" id="form-complaint-<?= $complaint['id']; ?>">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="PUT" name="_method">
                                            <input type="hidden" value="" name="approved" id="form-approved-by-member-<?= $complaint['id']; ?>">
                                            <button type="button" data-complaint-id="<?= $complaint['id']; ?>" class="btn-finish btn-sm btn icon icon-left btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Terima </button>
                                            <button type="button" data-complaint-id="<?= $complaint['id']; ?>" class="btn-reject btn-sm btn icon icon-left btn-danger"> Tolak </button>
                                        </form>
                                    <?php else: ?>
                                        -
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
        });

        $('.btn-finish').on('click', function () {
            var complaintId = $(this).data('complaint-id');

            process(complaintId, 1);
        });

        $('.btn-reject').on('click', function () {
            var complaintId = $(this).data('complaint-id');

            process(complaintId, 0);
        });

        function process(complaintId, status) {
            var reply = $('#form-approved-by-member-' + complaintId);

            $('#form-complaint-status-' + complaintId).val(status);

            Swal.fire({
                title: 'Yakin ' + (status === 1 ? 'selesai' : 'tolak') + ' ?',
                confirmButtonText: 'Simpan',
            }).then(function (result) {
                if (result.isConfirmed) {
                    reply.val(status);
                    $('#form-complaint-' + complaintId).submit();
                }
            });
        }
    </script>
<?= $this->endSection() ?>

<?= $this->extend('layouts/member/member') ?>

<?= $this->section('content-title') ?>
    Payment
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <?php /** @var array $payments */ ?>
    <?php /** @var array $room */ ?>
    <?php /** @var array $roomType */ ?>
    <?php /** @var array $facilities */ ?>
    <?php /** @var array $facilityTotalPrice */ ?>

    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm-8">
                        <h4 class="card-title">Histori Pembayaran</h4>
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
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Form Pembayaran
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
                                                                            <label for="disabledInput">Harga Sewa</label>
                                                                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= format_currency($room['price']); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="disabledInput">Harga Semua Fasilitas</label>
                                                                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= format_currency($facilityTotalPrice); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="disabledInput">Total Yang Harus Dibayar</label>
                                                                            <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="<?= format_currency($room['price'] + $facilityTotalPrice); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="description">Keterangan</label>
                                                                            <input type="text" id="description" class="form-control" name="description" placeholder="Boleh dikosongkan">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="payment_date">Tanggal Pembayaran</label>
                                                                            <input type="month" id="payment_date" class="form-control" name="payment_date" placeholder="Tanggal Pembayaran">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="payment_type">Tipe Pembayaran</label>
                                                                            <select name="payment_type" id="payment_type" class="form-control">
                                                                                <option value="">-- Nothing Selected --</option>
                                                                                <option value="<?= \App\Models\Payment::TYPE_CASH; ?>"><?= ucwords(\App\Models\Payment::TYPE_CASH); ?></option>
                                                                                <option value="<?= \App\Models\Payment::TYPE_TRANSFER; ?>"><?= ucwords(\App\Models\Payment::TYPE_TRANSFER); ?></option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="mb-3">
                                                                            <label for="proof" class="form-label">Unggah Bukti Pembayaran</label>
                                                                            <input accept="image/jpeg,image/png,image/jpg" class="form-control" type="file" id="proof">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="">Informasi Pembayaran : </label>
                                                                        <div>
                                                                            <span class="d-block mb-2">pembayaran dapat dilakukan melalui transfer ke rekening:</span>
                                                                            <ul class="">
                                                                                <li>BCA a/n Fransiscus Nathanael 43502822163 dan </li>
                                                                                <li>Mandiri a/n Liana Putri Margaret 1450010953330 </li>
                                                                            </ul>
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
                            <th>Tanggal/ <br>
                                Bulan</th>
                            <th>Harga</th>
                            <th>Fasilitas</th>
                            <th>Tipe Kamar</th>
                            <th>Bukti Pembayaran</th>
                            <th>Tipe Pembayaran</th>
                            <th>Deskripsi</th>
                            <th>Balasan Admin</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td class="text-bold-500"><?= date('d F Y', strtotime($payment['payment_date'])); ?></td>
                                    <td><?= format_currency($room['price']); ?></td>
                                    <td class="text-bold-500"><?= count($facilities) > 0 ? join(', ', array_column($facilities, 'facility_name')) : '-'; ?></td>
                                    <td><?= $roomType['name']; ?></td>
                                    <td>
                                        <a href="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>" class="image-zoom">
                                            <img src="<?= base_url('uploads/images/payments') . DIRECTORY_SEPARATOR . $payment['proof']; ?>" alt="" style="width: 150px; height: 150px;">
                                        </a>
                                    </td>
                                    <td><?= ucwords($payment['payment_type']); ?></td>
                                    <td><?= $payment['description'] ?: '-'; ?></td>
                                    <td><?= $payment['reply'] ?: '-'; ?></td>
                                    <td>
                                        <?php if ($payment['status'] == \App\Models\Payment::STATUS_PAID_OFF): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php elseif ($payment['status'] == \App\Models\Payment::STATUS_UNVERIFIED): ?>
                                            <span class="badge bg-warning">Belum Diverifikasi</span>
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
    </section>

<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        $('.btn-add').on('click', function () {
            var description  = $('#description');
            var proof        = $('#proof');
            var paymentDate  = $('#payment_date');
            var paymentType  = $('#payment_type');

            var form = new FormData();
            form.append('room_id', '<?= $room["id"]; ?>');
            form.append('description', description.val());
            form.append('payment_date', paymentDate.val() + '-01');
            form.append('payment_type', paymentType.find(':selected').val());
            form.append('proof', proof[0].files.length > 0 ? proof[0].files[0] : null);

            $.ajax({
                url: '<?= route_to("admin.payments.store"); ?>',
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

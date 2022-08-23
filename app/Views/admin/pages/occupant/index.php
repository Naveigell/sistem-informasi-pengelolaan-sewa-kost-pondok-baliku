<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Penghuni Kos</h4>
            </div>
            <div class="card-content">
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>No. Kamar</th>
                            <th>Nama</th>
                            <th>Pekerjaan</th>
                            <th>KTP</th>
                            <th>No. Telpon</th>
                            <th>Alamat Asal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /** @var array $occupants */
                        foreach ($occupants as $occupant): ?>

                            <?php
                                $biodata = (new \App\Models\Biodata())->where('user_id', $occupant['id'])->first();
                                $pivot   = (new \App\Models\RoomUserPivot())->where('user_id', $occupant['id'])->first();

                                $room    = (new \App\Models\Room())->where('id', $pivot['room_id'])->first();
                            ?>

                            <tr>
                                <td><?= $room['room_number']; ?></td>
                                <td class="text-bold-500"><?= $occupant['name']; ?></td>
                                <td><?= $biodata['job']; ?></td>
                                <td class="text-bold-500">
                                    <a href="<?= base_url('uploads/images/occupants') . DIRECTORY_SEPARATOR . $biodata['identity_card']; ?>" class="image-zoom">
                                        <img src="<?= base_url('uploads/images/occupants') . DIRECTORY_SEPARATOR . $biodata['identity_card']; ?>" alt="" style="width: 150px; height: 150px;">
                                    </a>
                                </td>
                                <td><?= $biodata['phone']; ?></td>
                                <td style="white-space: initial;"><?= $biodata['address']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#modal-occupant-<?= $occupant['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        Ubah
                                    </button>
                                    <!-- Vertically Centered modal Modal -->
                                    <div class="modal fade" id="modal-occupant-<?= $occupant['id']; ?>" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Data Penghuni Kos
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form class="form">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-12 d-none alert alert-danger" id="error-messages-<?= $occupant['id']; ?>"></div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="basicInput">No. Kamar</label>
                                                                                <input type="text" class="form-control" id="basicInput" placeholder="Nama Penghuni" value="<?= $room['room_number']; ?>" disabled>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="basicInput">Pekerjaan</label>
                                                                                <input type="text" class="form-control" id="occupant-job-<?= $occupant['id']; ?>" placeholder="Pekerjaan" value="<?= $biodata['job']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="basicInput">Nama Penghuni</label>
                                                                                <input type="text" class="form-control" id="occupant-name-<?= $occupant['id']; ?>" placeholder="Nama Penghuni" value="<?= $occupant['name']; ?>">
                                                                            </div>
                                                                            <div class="col-md-12 col-12">
                                                                                <label for="basicInput">No. Telpon</label>
                                                                                <div class="input-group mb-3">
                                                                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                                                                    <input type="text" class="form-control" id="occupant-phone-<?= $occupant['id']; ?>" placeholder="8123456789" aria-label="Username" aria-describedby="basic-addon1" value="<?= $biodata['phone']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="basicInput">Alamat Asal</label>
                                                                                <input type="text" class="form-control" id="occupant-address-<?= $occupant['id']; ?>" placeholder="JL. Suka Maju, Denpasar" value="<?= $biodata['address']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-group">
                                                                                <label for="basicInput">Password</label>
                                                                                <input type="password" class="form-control" id="occupant-password-<?= $occupant['id']; ?>" placeholder="Secret ..">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="mb-3">
                                                                                <label for="formFile" class="form-label">Unggah Foto KTP</label>
                                                                                <input class="form-control" type="file" id="occupant-file-<?= $occupant['id']; ?>">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">

                                                                    </div>

<!--                                                                    <div class="col-12 d-flex justify-content-end">-->
<!--                                                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>-->
<!--                                                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>-->
<!--                                                                    </div>-->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary ml-1 save-occupant" data-occupant-id="<?= $occupant['id']; ?>">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Simpan</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        $('.save-occupant').on('click', function () {
            var occupantId       = $(this).data('occupant-id');
            var occupantName     = $('#occupant-name-' + occupantId);
            var occupantJob      = $('#occupant-job-' + occupantId);
            var occupantPhone    = $('#occupant-phone-' + occupantId);
            var occupantAddress  = $('#occupant-address-' + occupantId);
            var occupantPassword = $('#occupant-password-' + occupantId);
            var idCardPhoto      = $('#occupant-file-' + occupantId);

            var form = new FormData();
            form.append('name', occupantName.val());
            form.append('job', occupantJob.val());
            form.append('phone', occupantPhone.val());
            form.append('address', occupantAddress.val());
            form.append('password', occupantPassword.val());
            form.append('identity_card', idCardPhoto[0].files.length > 0 ? idCardPhoto[0].files[0] : null);
            form.append('_method', 'PUT');

            $.ajax({
                url: '<?= base_url("admin/occupants") ?>/' + occupantId,
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (response, statusText, status) {
                    window.location.reload();
                },
                error: function (response) {
                    render_errors($("#error-messages-" + occupantId), JSON.parse(response.responseText));
                }
            });

        })
    </script>
<?= $this->endSection() ?>
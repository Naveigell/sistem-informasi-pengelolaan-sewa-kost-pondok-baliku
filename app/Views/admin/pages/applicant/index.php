<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Pelamar
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

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
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>No. Telpon</th>
                                <th>Alamat Asal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /** @var array $applicants */
                            foreach ($applicants as $applicant): ?>

                                <tr>
                                    <td class="text-bold-500"><?= $applicant['name']; ?></td>
                                    <td><?= $applicant['job']; ?></td>
                                    <td>
                                        <?php if ($applicant['is_approved'] == 1): ?>
                                            <a target="_blank" href="https://wa.me/<?= $applicant['phone']; ?>" class=""><?= $applicant['phone']; ?></a>
                                        <?php else: ?>
                                            <?= $applicant['phone']; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td style="white-space: initial;"><?= $applicant['address']; ?></td>
                                    <td>
                                        <?php if ($applicant['is_approved'] == 0): ?>
                                            <button type="button" class="btn-confirmation btn btn-sm btn-outline-primary block" data-applicant-id="<?= $applicant['id']; ?>">
                                                Konfirmasi
                                            </button>
                                            <button type="button" class="btn-reject btn btn-sm btn-outline-danger block" data-applicant-id="<?= $applicant['id']; ?>">
                                                Tolak
                                            </button>
                                            <form method="post" action="<?= route_to('admin.applicants.approve', $applicant['id']); ?>" class="d-none" id="form-approve-<?= $applicant['id']; ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="PUT" name="_method">
                                            </form>
                                            <form method="post" action="<?= route_to('admin.applicants.reject', $applicant['id']); ?>" class="d-none" id="form-reject-<?= $applicant['id']; ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" value="PUT" name="_method">
                                            </form>
                                        <?php elseif ($applicant['is_approved'] == 1): ?>
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
    <script>
        $('.btn-confirmation').on('click', function () {

            var id   = $(this).data('applicant-id');
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

            var id   = $(this).data('applicant-id');
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

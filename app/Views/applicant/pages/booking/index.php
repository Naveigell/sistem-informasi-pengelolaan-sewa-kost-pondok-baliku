<?= $this->extend('layouts/applicant/applicant') ?>

<?= $this->section('content-title') ?>
    Pemesanan Kamar
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

    <section class="row">
        <div class="col-12">
            <div class="row">

                <section class="section">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Silahkan pilih tipe kamar dan fasilitas yang diingingkan</h5>
                                </div>
                                <form class="card-body" method="post" action="<?= route_to('applicant.bookings.store'); ?>" id="booking-form">
                                    <?= csrf_field(); ?>
                                    <div>
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <p></p>
                                                        <h4 class="card-title">Pilihan kamar</h4>
                                                        <?php /** @var array $roomTypes */
                                                        foreach ($roomTypes as $type): ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="room_type" id="room-type-<?= $type['id']; ?>" value="<?= $type['id']; ?>">
                                                                <label class="form-check-label" for="room-type-<?= $type['id']; ?>">
                                                                    Kamar <?= $type['name']; ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <p></p>
                                                        <h4 class="card-title">Pilihan fasilitas</h4>
                                                        <ul class="list-group">
                                                            <?php /** @var array $roomFacilities */
                                                            foreach ($roomFacilities as $facility): ?>
                                                                <li class="list-group-item">
                                                                    <input disabled data-price="<?= $facility['facility_price']; ?>" class="form-check-input me-1 room-facilities" id="room-facility-<?= $facility['id']; ?>" name="facilities[]" type="checkbox" value="<?= $facility['id']; ?>" aria-label="">
                                                                    <label for="room-facility-<?= $facility['id']; ?>"><?= $facility['facility_name']; ?></label>
                                                                    <label style="float: right;" class="d-inline-block badge badge-success"><?= format_currency($facility['facility_price']); ?></label>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="card-header">
                                                    <h4 class="card-title">Total harga</h4>
                                                </div>
                                                <div class="col-lg-4 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Addon on both side" readonly id="total">
                                                        <input type="hidden" name="total" value="" id="total-hidden">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Keterangan tambahan</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-floating">
                                                    <textarea name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="resize: none; height: 200px;"></textarea>
                                                    <label for="floatingTextarea">Comments</label>
                                                </div>
                                                <button type="submit" class="btn icon icon-left btn-success d-block mt-3"><i data-feather="check-circle"></i>Pesan</button>
                                            </div>
                                        </div>
                                    </div>
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

<?= $this->section('content-script') ?>
    <script>
        var facilities = $('.room-facilities');
        var total      = 0;

        addEventOnChangeToFacilities();

        function calculateTotal(facility) {

            if ($(facility).is(':checked')) {
                total += $(facility).data('price');
            } else {
                total -= $(facility).data('price');
            }

            total = Math.max(0, total);
        }

        function addEventOnChangeToFacilities() {
            for (var facility of facilities) {
                $(facility).on('change', function (e) {
                    calculateTotal(this);

                    renderTotal();
                });
            }
        }

        $('#booking-form').on('submit', function () {
            for (var facility of facilities) {
                $(facility).prop('disabled', false);
            }
        });

        $('input[type=radio]').change(function (e) {
            var value = e.target.value;

            total = 0;

            for (var facility of facilities) {

                if (value == 1 || value == 3) {
                    $(facility).prop('checked', true);
                }

                $(facility).prop('disabled', value == 1 || value == 3);

                calculateTotal(facility);
                renderTotal();
            }
        });

        function renderTotal() {
            $('#total').val(thousandSeparator(total));
            $('#total-hidden').val(total);
        }
    </script>
<?= $this->endSection() ?>
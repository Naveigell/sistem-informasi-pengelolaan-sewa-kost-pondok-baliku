<?php

use App\Models\Room;
use App\Models\RoomUserPivot;

?>
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

                                                        <?php if ($errors = session()->getFlashdata('errors')) : ?>
                                                            <div class="alert-danger alert text-left">
                                                                <ul>
                                                                    <?php foreach ($errors as $error) : ?>
                                                                        <li><?= $error; ?></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>

                                                        <p></p>
                                                        <h4 class="card-title">Pilihan kamar</h4>
                                                        <script>
                                                            var roomTypeMustBeDisabled = [];
                                                        </script>
                                                        <?php /** @var array $roomTypes */
                                                        foreach ($roomTypes as $type): ?>

                                                            <?php
                                                                $rooms = (new Room())->where('room_type_id', $type['id'])->findAll();
                                                                $ids   = array_column($rooms, 'id');

                                                                $pivot = (new RoomUserPivot())->whereIn('room_id', $ids)->where('user_id IS NULL')->findAll();
                                                                $emptyRooms = count($pivot);
                                                            ?>

                                                            <?php if ($emptyRooms <= 0): ?>
                                                                <script>
                                                                    roomTypeMustBeDisabled.push(<?= $type['id']; ?>);
                                                                </script>
                                                            <?php endif; ?>

                                                            <div class="form-check">
                                                                <input data-room-price="<?= $type['rent_price']; ?>" data-room-type-id="<?= $type['id']; ?>" class="form-check-input" type="radio" name="room_type" id="room-type-<?= $type['id']; ?>" value="<?= $type['id']; ?>">
                                                                <label class="form-check-label" for="room-type-<?= $type['id']; ?>">
                                                                    Kamar <?= $type['name']; ?>
                                                                    <?php if ($emptyRooms > 0): ?>
                                                                        (sisa <?= $emptyRooms; ?> kamar lagi)
                                                                    <?php else: ?>
                                                                        (penuh)
                                                                    <?php endif; ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <p></p>
                                                        <h4 class="card-title">Pilihan durasi</h4>
                                                        <div class="form-check p-0">
                                                            <select name="room_rent_duration_id" id="duration" class="form-control">
                                                                <option value="">-- Nothing Selected --</option>
                                                                <?php /** @var array $roomDurations */
                                                                foreach ($roomDurations as $duration): ?>
                                                                    <option data-month-total="<?= $duration['month_total']; ?>" data-discount="<?= $duration['discount_in_percent']; ?>" value="<?= $duration['id']; ?>"><?= $duration['name']; ?> -- (Diskon <?= $duration['discount_in_percent']; ?> %)</option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <p></p>
                                                        <h4 class="card-title">Pilihan fasilitas</h4>
                                                        <ul class="list-group">
                                                            <?php /** @var array $roomFacilities */
                                                            foreach ($roomFacilities as $facility): ?>
                                                                <li class="list-group-item">
                                                                    <input <?= $facility['is_disabled'] ? 'checked' : ''; ?> disabled data-price="<?= $facility['facility_price']; ?>" class="form-check-input me-1 <?= $facility['is_disabled'] ? 'room-facilities-disabled' : 'room-facilities'; ?>" id="room-facility-<?= $facility['id']; ?>" name="facilities[]" type="checkbox" value="<?= $facility['id']; ?>" aria-label="">
                                                                    <label for="room-facility-<?= $facility['id']; ?>"><?= $facility['facility_name']; ?> <?= $facility['is_disabled'] ? '(include)' : ''; ?></label>
                                                                    <label style="float: right;" class="d-inline-block badge badge-success"><?= $facility['facility_price'] <= 0 ? 'Rp. -' : format_currency($facility['facility_price']); ?></label>
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
                                                    <h4 class="card-title">Harga Per Bulan</h4>
                                                </div>
                                                <div class="col-lg-4 mb-1">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Addon on both side" readonly id="price-per-month">
                                                        <input type="hidden" name="total" value="" id="price-per-month-hidden">
                                                    </div>
                                                </div>
                                            </div>
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
                                                    <textarea name="message" class="form-control" placeholder="Leave a comment here" id="booking-comment" style="resize: none; height: 200px;"></textarea>
                                                    <label for="floatingTextarea">Comments</label>
                                                </div>
                                                <button type="submit" class="btn icon icon-left btn-success d-block mt-3" id="booking-button"><i data-feather="check-circle"></i>Pesan</button>
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
        var facilities        = $('.room-facilities');
        var total             = 0;
        var basePrice         = 0;
        var discountPercent   = 0;
        var monthRentDuration = 0;

        addEventOnChangeToFacilities();

        function calculateTotal(facility) {

            if ($(facility).is(':checked')) {
                total += $(facility).data('price');
            } else {
                total -= $(facility).data('price');
            }

            total = Math.max(200000, total);
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

            for (var facility of $('.room-facilities-disabled')) {
                $(facility).prop('disabled', false);
            }
        });

        $('#duration').change(function (e) {
            discountPercent   = $(this).find(":selected").data('discount');
            monthRentDuration = $(this).find(":selected").data('month-total');

            renderTotal();
        });

        $('input[type=radio]').change(function (e) {
            var value      = e.target.value;
            var roomTypeId = $(this).data('room-type-id');

            basePrice = $(this).data('room-price');

            total = 200000;

            for (var facility of facilities) {

                if (value == 1) {
                    $(facility).prop('checked', true);
                } else if (value == 3) {
                    $(facility).prop('checked', false);
                }

                $(facility).prop('disabled', value == 1 || value == 3);

                calculateTotal(facility);
                renderTotal();
            }

            if (roomTypeMustBeDisabled.includes(roomTypeId)) {
                facilities.prop('disabled', true);

                $('#booking-button').addClass('d-none');
                $('#booking-comment').prop('disabled', true);
            } else {

                $('#booking-comment').prop('disabled', false);
                $('#booking-button').removeClass('d-none');
            }
        });

        function renderTotal() {

            var discountTotal = (discountPercent / 100) * (basePrice + total);

            var fullTotal = (basePrice + total) - discountTotal;

            $('#total').val(thousandSeparator(fullTotal * monthRentDuration));
            $('#total-hidden').val(fullTotal * monthRentDuration);

            $('#price-per-month').val(thousandSeparator(fullTotal));
        }
    </script>
<?= $this->endSection() ?>
<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <h4 class="card-title">Data Kamar</h4>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Nomor Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Fasilitas</th>
                            <th>Harga Sewa</th>
                            <th>Durasi Sewa</th>
                            <th>Nama Penghuni</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        /** @var array $rooms */
                        /** @var array $availableUsers */
                        /** @var array $availableFacilities */
                        /** @var array $roomTypes */
                        /** @var array $roomRentDurations */

                        foreach ($rooms as $room): ?>

                            <?php
                                $type       = (new \App\Models\RoomType())->where('id', $room['room_type_id'])->first();
                                $duration   = (new \App\Models\RoomRentDuration())->where('id', $room['room_rent_duration_id'])->first();
                                $facilities = (new \App\Models\RoomFacilityPivot())->withFacilities()->where('room_id', $room['id'])->findAll();
                                $user       = (new \App\Models\RoomUserPivot())->withUser()
                                                                                ->where('room_id', $room['id'])
                                                                                ->orderBy('room_user_pivot.id', 'DESC')
                                                                                ->first();

                                $activeFacilities = array_filter($facilities, function ($facility) {
                                    return $facility['is_active'];
                                });
                            ?>

                            <tr>
                                <td class="text-bold-500"><?= $room['room_number']; ?></td>
                                <td><?= $type['name']; ?></td>
                                <td class="text-bold-500"><?= join(', ', array_column($activeFacilities, 'facility_name')); ?></td>
                                <td><?= format_currency($room['price']); ?></td>
                                <td><?= $duration['name']; ?></td>
                                <td><?= $user ? $user['name'] : '-'; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#modal-room-<?= $room['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        Ubah
                                    </button>
                                    <!-- Vertically Centered modal Modal -->
                                    <div class="modal fade" id="modal-room-<?= $room['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kamar</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form class="form">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label>Fasilitas yang digunakan</label>

                                                                        <?php foreach ($availableFacilities as $availableFacility): ?>
                                                                            <?php
                                                                                $index = array_search($availableFacility['id'], array_column($facilities, 'facility_id'));
                                                                            ?>
                                                                            <div class="checkbox">
                                                                                <input type="checkbox" id="checkbox-<?= $room['id']; ?>-<?= $availableFacility['id']; ?>" class="form-check-input facility-<?= $availableFacility['id']; ?>-<?= $room['id']; ?>" <?php if (is_int($index) && $facilities[$index]['is_active']): ?> checked <?php endif; ?>>
                                                                                <label for="checkbox-<?= $room['id']; ?>-<?= $availableFacility['id']; ?>"><?= $availableFacility['facility_name']; ?></label>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Nama Penghuni</label>
                                                                        <fieldset class="form-group">
                                                                            <select class="form-select" id="room-occupant-<?= $room['id']; ?>">
                                                                                <option value="">-- Nothing Selected --</option>
                                                                                <?php foreach ($availableUsers as $availableUser): ?>
                                                                                    <option <?php if ($user && $availableUser['id'] == $user['user_id']): ?> selected <?php endif; ?> value="<?= $availableUser['id']; ?>"><?= $availableUser['name']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <label for="basicInput">Harga Sewa</label>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text">Rp</span>
                                                                            <input type="text" class="form-control nominal" id="room-price-<?= $room['id']; ?>" value="<?= $room['price']; ?>" placeholder="Harga Sewa" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <label>Tipe Kamar</label>
                                                                    <fieldset class="form-group">
                                                                        <select class="form-select" id="room-type-<?= $room['id']; ?>">
                                                                            <?php foreach ($roomTypes as $roomType): ?>
                                                                                <option <?php if ($roomType['id'] == $room['room_type_id']): ?> selected <?php endif; ?> value="<?= $roomType['id']; ?>"><?= $roomType['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </fieldset>
                                                                    <label>Durasi Sewa</label>
                                                                    <fieldset class="form-group">
                                                                        <select class="form-select" id="room-rent-duration-<?= $room['id']; ?>">
                                                                            <?php foreach ($roomRentDurations as $duration): ?>
                                                                                <option <?php if ($duration['id'] == $room['room_rent_duration_id']): ?> selected <?php endif; ?> value="<?= $duration['id']; ?>"><?= $duration['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="company-column">Nomor Kamar</label>
                                                                        <input type="text" id="room-number-<?= $room['id']; ?>" class="form-control" name="company-column" value="<?= $room['room_number']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">

                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="button" class="btn btn-primary me-1 mb-1 save-room" data-room-id="<?= $room['id']; ?>">Simpan</button>
                                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
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
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script>
        var facilityIds = <?= json_encode(array_column($availableFacilities, 'id'));?>;

        $('.save-room').on('click', function () {

            var roomId           = $(this).data('room-id');
            var facilities       = [];
            var roomType         = $('#room-type-' + roomId);
            var roomRentDuration = $('#room-rent-duration-' + roomId);
            var roomPrice        = $('#room-price-' + roomId);
            var roomOccupant     = $('#room-occupant-' + roomId);
            var roomNumber       = $('#room-number-' + roomId);

            for (var facilityId of facilityIds) {

                var checked = $('.facility-' + facilityId + '-' + roomId).is(':checked');

                if (checked) {
                    facilities.push(facilityId);
                }
            }

            $.ajax({
                url: '<?= base_url("admin/rooms") ?>/' + roomId,
                type: 'POST',
                data: {
                    _method: 'PUT',
                    room_id: roomId,
                    facilities,
                    room_type_id: roomType.val(),
                    room_rent_duration_id: roomRentDuration.val(),
                    room_number: roomNumber.val(),
                    price: roomPrice.inputmask('unmaskedvalue'),
                    user_id: roomOccupant.val(),
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });


    </script>
<?= $this->endSection() ?>

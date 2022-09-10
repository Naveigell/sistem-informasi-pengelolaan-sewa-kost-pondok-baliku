<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>

<section class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Jumlah Penghuni Kos</h6>
                                <h6 class="font-extrabold mb-0"><?= $activeMemberCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldDanger"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Jumlah Kamar Tersedia</h6>
                                <h6 class="font-extrabold mb-0"><?= $emptyRoomCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon yellow" style="background-color: #f3ec25;">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Jumlah Pelamar</h6>
                                <h6 class="font-extrabold mb-0"><?= $applicantCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Pending Pembayaran</h6>
                                <h6 class="font-extrabold mb-0"><?= $unverifiedPaymentCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green" style="background-color: #eae355;">
                                    <i class="iconly-boldPaper"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Komplain Yang Belum Selesai</h6>
                                <h6 class="font-extrabold mb-0"><?= $complaintCount; ?></h6>
                            </div>
                        </div>
                    </div>
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

    <?php if (count($rooms) > 0): ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <h4 class="card-title">Kamar Yang Belum Membayar Bulan Depan</h4>
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

                                          if (!$user) {
                                              continue;
                                          }
                                      ?>
                                      <tr>
                                          <td class="text-bold-500"><?= $room['room_number']; ?></td>
                                          <td><?= $type['name']; ?></td>
                                          <td class="text-bold-500"><?= join(', ', array_column($activeFacilities, 'facility_name')); ?></td>
                                          <td><?= format_currency($room['price']); ?></td>
                                          <td><?= $duration['name']; ?></td>
                                          <td><?= $user ? $user['name'] : '-'; ?></td>
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
    <?php endif; ?>

</section>

<?= $this->endSection() ?>


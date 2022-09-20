<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 "><h3>Selamat datang, Admin</h3>
            </div>
            <div class="col-sm-2 ">

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"><?= session('user')->name; ?></h6>
                                <p class="mb-0 text-sm text-gray-600">Admin</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="<?= base_url('assets/images/faces/1.jpg'); ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 1rem;">
                        <li>
                            <h6 class="dropdown-header"><?= session('user')->name; ?></h6>
                        </li>
                        <li><a class="dropdown-item" href="<?= route_to('admin.accounts.index'); ?>">Akun</a></li>
                        <li><a class="dropdown-item" href="<?= route_to('logout'); ?>">Logout</a></li>
                    </ul>
                </div><br>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Content Start -->
</div>

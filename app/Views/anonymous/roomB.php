<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kamar B | Pondok Baliku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('anonymous/css/open-iconic-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/animate.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('anonymous/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/owl.theme.default.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/magnific-popup.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('anonymous/css/aos.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('anonymous/css/ionicons.min.css'); ?>">

    <link rel="stylesheet" href="<?= base_url('anonymous/css/bootstrap-datepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/jquery.timepicker.css'); ?>">


    <link rel="stylesheet" href="<?= base_url('anonymous/css/flaticon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/icomoon.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('anonymous/css/style.css'); ?>">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?= route_to('anonymous.index'); ?>">Pondok Baliku</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="nav-item"><a href="<?= route_to('login.index'); ?>" class="nav-link">Login</a></span>
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="<?= route_to('login.index'); ?>" class="nav-link">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap" style="background-image: url(<?= base_url('anonymous/images/bg_1.jpg') ?>);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <h1 class="mb-4 bread">Pilihan Kamar</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 ftco-animate">
                            <h2 class="mb-4">Tipe B</h2>
                            <div class="single-slider owl-carousel">
                                <div class="item">
                                    <div class="room-img" style="background-image: url(<?= base_url('anonymous/images/b-1.jpg') ?>);"></div>
                                </div>
                                <div class="item">
                                    <div class="room-img" style="background-image: url(<?= base_url('anonymous/images/b-2.jpg') ?>); background-size: auto 100%;"></div>
                                </div>
                                <div class="item">
                                    <div class="room-img" style="background-image: url(<?= base_url('anonymous/images/b-3.jpg') ?>);"></div>
                                </div>
                                <div class="item">
                                    <div class="room-img" style="background-image: url(<?= base_url('anonymous/images/b-4.jpg') ?>);"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                            <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>

                            <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                        </div>
                        <div class="col-12 room-single mt-4 mb-5 ftco-animate">
                            <?php
                            /**
                             * @var array $rooms
                             */
                            ?>
                            <?php if (count($rooms) > 0) : ?>
                                <h4 class="mb-4">Tersisa <?= count($rooms); ?> kamar lagi!</h4>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12 room-single ftco-animate mb-5 mt-5">
                            <h4 class="mb-4">Pilihan Lainnya&nbsp;</h4>
                            <div class="row">
                                <div class="col-sm col-md-6 ftco-animate">
                                    <div class="room">
                                        <a href="<?= route_to('anonymous.rooms-a.index'); ?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url('anonymous/images/room-1.jpg') ?>);">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="text p-3 text-center">
                                            <h3 class="mb-3"><a href="<?= route_to('anonymous.rooms-a.index'); ?>">Tipe A</a></h3>
                                            <p><span class="price mr-2">Rp. 2.000K</span> <span class="per">/ Bulan</span></p>
                                            <hr>
                                            <p class="pt-1"><a href="<?= route_to('anonymous.rooms-a.index'); ?>" class="btn-custom">Lihat Lebih Detail&nbsp; <span class="icon-long-arrow-right"></span></a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm col-md-6 ftco-animate">
                                    <div class="room">
                                        <a href="<?= route_to('anonymous.rooms-c.index'); ?>" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url('anonymous/images/room-2.jpg') ?>);">
                                            <div class="icon d-flex justify-content-center align-items-center">
                                                <span class="icon-search2"></span>
                                            </div>
                                        </a>
                                        <div class="text p-3 text-center">
                                            <h3 class="mb-3"><a href="<?= route_to('anonymous.rooms-c.index'); ?>">Tipe C&nbsp;</a></h3>
                                            <p><span class="price mr-2">Rp. 1.000K</span> <span class="per">/ Bulan</span></p>
                                            <hr>
                                            <p class="pt-1"><a href="<?= route_to('anonymous.rooms-c.index'); ?>" class="btn-custom">Lihat Lebih Detail&nbsp; <span class="icon-long-arrow-right"></span></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- .col-md-8 -->

            </div>
        </div>
    </section> <!-- .section -->

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Pondok Baliku</h2>
                        <p>Your satisfaction is our prime concern</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-whatsapp"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Lainnya</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Tentang Kami</a></li>
                            <li><a href="#" class="py-2 d-block">Tata Tertib Penghuni</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Hubungi Kami</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">JL. Gn. Kalimutu No.26, Pemecutan Klod, Denpasar, Bali.</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 818 0874 7555</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">pondokbaliku@gmail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="<?= base_url('anonymous/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/popper.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.easing.1.3.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.waypoints.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.stellar.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.magnific-popup.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/aos.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.animateNumber.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/jquery.timepicker.min.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/scrollax.min.js'); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="<?= base_url('anonymous/js/google-map.js'); ?>"></script>
    <script src="<?= base_url('anonymous/js/main.js'); ?>"></script>

</body>

</html>
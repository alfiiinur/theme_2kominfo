<?php 

  require('conf/config.php');
  require('conf/phpFunction.php');

  $profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
  $prof = $profile->fetch_all(MYSQLI_ASSOC);


  $video =  $mysqli->query('SELECT vd_url from pub_videos WHERE _active=1 ORDER BY vd_id DESC LIMIT 1');
  $get_url = $video->fetch_all(MYSQLI_ASSOC);
  $url = $get_url[0]['vd_url'];
  $queryID = parse_url($url, PHP_URL_QUERY);
  parse_str($queryID, $params);
  $videoId = $params['v'];
  
  $pengumuman =  $mysqli->query('SELECT COUNT(*) as pengumuman FROM pub_post WHERE ca_id="003" AND _active="1" AND post_datex >= CURDATE()');
  $count = mysqli_fetch_assoc($pengumuman);

  $event =  $mysqli->query('SELECT COUNT(*) as event FROM pub_post WHERE ca_id="002" AND _active="1" AND post_datex >= CURDATE()');
  $countEvent = mysqli_fetch_assoc($event);

  if ($count['pengumuman'] > 0)
  
  {
    echo "<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>";
    echo 
    "<script type='text/javascript'>
      $(document).ready(function () {
          $('#announcementModal').modal('show');
      });
    </script>";
  }

//   $ip_address = getIp();
//   $os = get_operating_system();
//   $browser = get_the_browser();
//   $visit_date = date('Y-m-d H:i:s');
//   addVisitToDatabase($ip_address, $os, $browser, $visit_date);
  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $prof[0]['prof_lnm']?></title>
    <link rel="shortcut icon" href="images/profile/<?= $prof[0]['prof_lg']?>">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon"> -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: May 13 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <?php 
        require_once('views/navbar.php');
        // require_once('views/visitor.php');
    ?>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section ">
            <?=requestRec('ban_title, ban_img', 'pub_banner', 'cat=001 AND _active=1', '_cre_date DESC',5, 1)?>

        </section><!-- /Hero Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">

            <div class="container" data-aos="zoom-in">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Link Terkait</h2>
                    <p>Kirimkan Link Terkait melalui form ini</p>
                </div><!-- End Section Title -->
                <div class="swiper">
                    <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 2,
                                "spaceBetween": 40
                            },
                            "480": {
                                "slidesPerView": 3,
                                "spaceBetween": 60
                            },
                            "640": {
                                "slidesPerView": 4,
                                "spaceBetween": 80
                            },
                            "992": {
                                "slidesPerView": 5,
                                "spaceBetween": 120
                            },
                            "1200": {
                                "slidesPerView": 6,
                                "spaceBetween": 120
                            }
                        }
                    }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <?=requestRec('sos_nm, sos_url, sos_ic', 'pub_socials', '_active=1 AND cat=2', 'sos_nm DESC', '', 11)?>
                    </div>
                </div>

            </div>

        </section><!-- /Clients Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Profil Pimpinan</h2>
                <p>Kepala <?= $_profile[0]['prof_lnm']?></p>
                </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?=requestRec('emp_nm, emp_desk, emp_lhkpn, jab_id, emp_img', 'pub_employees', 'jab_id=001 AND _active=1', '','', 2)?>
                    </div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->


        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>
                <p><?= $prof[0]['prof_snm']?> Memberikan Layanan yang terbaik untuk anda</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <?= requestRec('post_id, post_judul, post_desk, post_img', 'pub_post', 'ca_id=005 AND _active=1', 'post_judul ASC', 4, 3) ?>
                </div>
            </div>
        </section><!-- /Services Section -->

        <!-- youtube Section -->
        <section id="team-2" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Media Digital</h2>
                <p>Ikuti dokumetasi aktivitas kegiatan lainnya melalui media digital kami</p>
            </div><!-- End Section Title -->

            <style>
            .carousel-item {
                height: 100%;
            }

            .embed-responsive-item {
                width: 100%;
                height: 100%;
            }

            .slider-container {
                position: relative;
            }

            .slider-control-prev,
            .slider-control-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: #47b2e4;
                border: none;
                border-radius: 50%;
                color: white;
                font-size: 2rem;
                width: 45px;
                height: 45px;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            .slider-control-prev {
                left: -60px;
            }

            .slider-control-next {
                right: -60px;
            }

            .slider-control-prev:hover,
            .slider-control-next:hover {
                background-color: #47b2e2;
                transition: 0.3s;
            }

            .visually-hidden {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                border: 0;
            }
            </style>
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-12 d-lg-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <div id="youtubeSlider" class="slider-container" style="width: 70%; height: 400px;">
                            <div class="carousel-inner" style="height: 100%; width: 100%; border-radius: 10px;">
                                <?= requestRec('vd_id, vd_url', 'pub_videos', '_active=1', 'vd_id DESC', 10, 6) ?>
                            </div>
                            <button class="slider-control-prev" type="button">
                                <span class="bi bi-arrow-left" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="slider-control-next" type="button">
                                <span class="bi bi-arrow-right" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div><!-- End Team Member -->
                </div>
            </div>


        </section><!-- /youtube Section -->

        <!-- berita Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Berita</h2>
                <p>Informasi terupdate kami sediakan bagi Anda</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <?=requestRec('post_id, post_judul, post_desk, post_publish, post_see, post_img', 'pub_post', 'ca_id=001 AND _active=1', 'post_publish DESC',4, 4)?>

                </div>
                <div class="swiper-pagination"></div>

            </div>

        </section><!-- /berita Section -->

        <!-- galeri Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri Terbaru</h2>
                <p>Dokumentasi kegiatan <?=$_profile[0]['prof_lnm']?></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <!-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Card</li>
                        <li data-filter=".filter-branding">Web</li>
                    </ul> -->
                    <!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        <?=requestRec('ban_title,ban_desk, ban_img', 'pub_banner', 'cat=002 AND _active=1', '_cre_date DESC',6, 7)?>
                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /galeri Section -->

        <!-- agenda kegiatan Section -->
        <section id="faq-2" class="faq-2 section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Agenda Kegiatan</h2>
                <p>Jadwal Kegiatan <?= $prof[0]['prof_snm']?></p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="faq-container">
                            <?= requestRec('post_id, post_judul, post_desk, post_publish, post_datex, post_img', 'pub_post', 'ca_id=002 AND _active=1 AND post_datex >= CURDATE()', 'post_publish DESC', '', 9) ?>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /agenda kegiatan Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kritik dan Saran</h2>
                <p>Kirimkan kritik dan saran melalui form ini</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p><?=$prof[0]['prof_addr']?></p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Call Us</h3>
                                    <p><?=$prof[0]['prof_telp']?></p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-mailbox flex-shrink-0"></i>
                                <div>
                                    <h3>Fax Mail Us</h3>
                                    <p><?=$prof[0]['prof_fax']?></p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Us</h3>
                                    <p><?=$prof[0]['prof_mail']?></p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-broadcast flex-shrink-0"></i>
                                <div>
                                    <h3>E-SKM : Survey Kepuasan</h3>
                                    <p><?=$prof[0]['prof_snm']?></p>
                                </div>
                            </div>
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-map-fill flex-shrink-0"></i>
                                <div>
                                    <h3>Alamat Lihat Google Maps</h3>

                                    <a href="<?=$prof[0]['prof_maps']?>">Google Maps</a>

                                </div>
                                <!-- End Info Item -->

                            </div>

                            <!-- <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                                frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="row gy-4">

                                <div class="col-md-12">
                                    <label for="name-field" class="pb-2">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Contoh: Renia Frans" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Email</label>
                                    <input type="email" class="form-control" id="mail" name="mail"
                                        placeholder="Contoh: reniafrans@gmail.com" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Message</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="5"
                                        required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit" name="submit" class="btn btn-primary"
                                        id="submit-message">Kirim
                                        pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->



    </main>


    <?php require_once('views/footer.php')?>
    <!-- counter pengunjung -->


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- START ANNOUNCEMENT MODAL -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="pengumumanModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="announcement-slide owl-carousel owl-theme">
                        <?=requestRec('post_id, post_judul, post_desk', 'pub_post', 'ca_id=003 AND _active=1 AND post_datex >= CURDATE()', '','', 8)?>
                    </div>
                    <div class="modal-footer border-0">
                        <a href="003/" type="button" class="btn btn-outline-primary">Pengumuman Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ANNOUNCEMENT MODAL -->

    <!-- START MODAL OTP-->
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="alert alert-danger" role="alert" style="display: none;">
                        Kode otp yang anda masukkan salah
                    </div>
                    <img src="images/3.png" alt="" style="width: 100%; border-radius: 8px;" class="mb-3">
                    <h5 class="fw-bolder">Verifikasi Email</h5>
                    <p class="fw-light">
                        Kami telah mengirimkan kode otp ke alamat email anda
                    </p>
                    <form class="form-otp" method="POST">
                        <div class="otp-field mb-4">
                            <input type="number" class="otp-input" name="key1" required />
                            <input type="number" class="otp-input" name="key2" disabled required />
                            <input type="number" class="otp-input" name="key3" disabled required />
                            <input type="number" class="otp-input" name="key4" disabled required />
                            <input type="number" class="otp-input" name="key5" disabled required />
                            <input type="number" class="otp-input" name="key6" disabled required />
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" name="submit" id="submit-otp"
                                class="col-11 btn btn-primary">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL OTP -->

    <!-- START SKM MODAL-->
    <div class="modal fade" id="ikmModal" tabindex="-1" aria-labelledby="otpModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <img src="images/4.png" alt="" style="width: 100%; border-radius: 8px;" class="mb-4">
                    <h4 class="fw-bolder">Verifikasi berhasil!</h4>
                    <p class="fw-bolder mb-0">Yuk isi survei kepuasan masyarakat pada tautan ini
                        <a href="<?=$prof[0]['prof_skm']?>">Survei kepuasan masyarakat Dinas Komunikasi dan
                            Informatika</a>
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <a href="" type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Lewati</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END SKM MODAL -->

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="js/embedYoutube.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- js file -->

    <script>
    // START FORM HEADLE OTP //
    const inputs = document.querySelectorAll(".otp-input")

    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }
        });
    });

    window.addEventListener("load", () => inputs[0].focus());

    $(document).ready(function() {
        $("#submit-message").click(function(e) {
            e.preventDefault();
            var formData = $('.form-message').serialize();

            $.ajax({
                type: 'POST',
                url: 'form/sendMessage.php',
                data: formData,
                success: function(response) {
                    console.log('Message sent successfully:', response);
                    $('#otpModal').modal('show');
                    $('.form-message')[0].reset();

                    $("#submit-otp").click(function(e) {
                        e.preventDefault();
                        var code = $('.form-otp').serialize();

                        $.ajax({
                            type: 'POST',
                            url: 'form/verifyOTP.php',
                            data: code,
                            dataType: 'json', // Menentukan tipe data yang diharapkan dari respons
                            success: function(response) {
                                console.log('Response:', response);
                                if (response.success) {
                                    console.log(
                                        'Message sent successfully:',
                                        response);
                                    $('#otpModal').modal('hide');
                                    $('#ikmModal').modal('show');
                                } else {
                                    $('.alert-danger').show();
                                }
                            }
                        });
                    });
                }
            });
        });
    });

    // END FORM HEADLE OTP //


    // youtube
    document.addEventListener('DOMContentLoaded', function() {
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;
        let currentPlayer = null;

        function showItem(index) {
            items.forEach((item, i) => {
                if (i === index) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        document.querySelector('.slider-control-prev').addEventListener('click', function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalItems - 1;
            showItem(currentIndex);
        });

        document.querySelector('.slider-control-next').addEventListener('click', function() {
            currentIndex = (currentIndex < totalItems - 1) ? currentIndex + 1 : 0;
            showItem(currentIndex);
        });

        showItem(currentIndex);

        document.querySelectorAll('.carousel-item img').forEach(function(img) {
            img.addEventListener('click', function() {
                var videoId = this.parentElement.getAttribute('data-video');
                if (currentPlayer) {
                    currentPlayer.pauseVideo(); // Pause the current player
                }
                var iframe = document.createElement('iframe');
                iframe.src = 'https://www.youtube.com/embed/' + videoId +
                    '?autoplay=1&rel=0&enablejsapi=1';
                iframe.width = '100%';
                iframe.height = '100%';
                iframe.frameBorder = '0';
                iframe.allow =
                    'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                iframe.allowFullscreen = true;
                iframe.id = 'youtubePlayer';
                this.parentElement.innerHTML = '';
                this.parentElement.appendChild(iframe);

                // Initialize new YT player
                currentPlayer = new YT.Player(iframe, {
                    events: {
                        'onStateChange': onPlayerStateChange
                    }
                });
            });
        });

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.PLAYING) {
                document.querySelectorAll('.carousel-item iframe').forEach(function(iframe) {
                    if (iframe !== event.target.getIframe()) {
                        new YT.Player(iframe).pauseVideo();
                    }
                });
            }
        }

        // Load YouTube IFrame Player API
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    });
    </script>


</body>

</html>
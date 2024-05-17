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
    <title>Service Details - Arsha Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
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

<body class="service-details-page">


    <?php 
        require_once('views/navbar.php');
        // require_once('views/visitor.php');
    ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container">
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Service Details</li>
                    </ol>
                </nav>
                <h1>Service Details</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="services-list">
                            <a href="#" class="active">Web Design</a>
                            <a href="#">Software Development</a>
                            <a href="#">Product Management</a>
                            <a href="#">Graphic Design</a>
                            <a href="#">Marketing</a>
                        </div>

                        <h4>Enim qui eos rerum in delectus</h4>
                        <p>Nam voluptatem quasi numquam quas fugiat ex temporibus quo est. Quia aut quam quod facere ut
                            non occaecati ut aut. Nesciunt mollitia illum tempore corrupti sed eum reiciendis. Maxime
                            modi rerum.</p>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/services.jpg" alt="" class="img-fluid services-img">
                        <h3>Temporibus et in vero dicta aut eius lidero plastis trand lined voluptas dolorem ut voluptas
                        </h3>
                        <p>
                            Blanditiis voluptate odit ex error ea sed officiis deserunt. Cupiditate non consequatur et
                            doloremque consequuntur. Accusantium labore reprehenderit error temporibus saepe perferendis
                            fuga doloribus vero. Qui omnis quo sit. Dolorem architecto eum et quos deleniti officia qui.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Aut eum totam accusantium voluptatem.</span>
                            </li>
                            <li><i class="bi bi-check-circle"></i> <span>Assumenda et porro nisi nihil nesciunt
                                    voluptatibus.</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea</span>
                            </li>
                        </ul>
                        <p>
                            Est reprehenderit voluptatem necessitatibus asperiores neque sed ea illo. Deleniti quam
                            sequi optio iste veniam repellat odit. Aut pariatur itaque nesciunt fuga.
                        </p>
                        <p>
                            Sunt rem odit accusantium omnis perspiciatis officia. Laboriosam aut consequuntur recusandae
                            mollitia doloremque est architecto cupiditate ullam. Quia est ut occaecati fuga. Distinctio
                            ex repellendus eveniet velit sint quia sapiente cumque. Et ipsa perferendis ut nihil.
                            Laboriosam vel voluptates tenetur nostrum. Eaque iusto cupiditate et totam et quia dolorum
                            in. Sunt molestiae ipsum at consequatur vero. Architecto ut pariatur autem ad non cumque
                            nesciunt qui maxime. Sunt eum quia impedit dolore alias explicabo ea.
                        </p>
                    </div>

                </div>

            </div>

        </section><!-- /Service Details Section -->

    </main>

    <!-- footer -->
    <?php require_once('views/footer.php')?>
    <!-- end footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
<?php 
   $profile =  $mysqli->query('SELECT * from pub_profile WHERE _active=1 ORDER BY _cre DESC');
   $_profile = $profile->fetch_all(MYSQLI_ASSOC);   
   
   $current_page = $_SERVER['REQUEST_URI'];

   // Menentukan jalur berdasarkan halaman yang sedang dimuat
   $footer_url = ($current_page === '') ? '' : '../';



?>

<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="d-flex align-items-center">
                    <img src="images/profile/<?= $_profile[0]['prof_lg']?>" style="width:70px ; height:70px ;" alt="">
                </a>
                <div class="footer-contact pt-3">

                    <p><?= $_profile[0]['prof_lnm']?></p>
                    <p><?= $_profile[0]['prof_desk']?></p>
                    <p class="mt-3"><strong>Phone:</strong> <span><?= $_profile[0]['prof_telp']?></span></p>
                    <p><strong>Email:</strong> <span><?= $_profile[0]['prof_mail']?></span></p>
                </div>
            </div>

            <?php 
            $data = $mysqli->query('SELECT * from set_menu WHERE _active=1');
            $_mnrecord = $data->fetch_all(MYSQLI_ASSOC);         
         ?>
            <?php foreach ($_mnrecord as $record): ?>
            <?php if ($record['parent'] == 0): ?>
            <div class="col-lg-2 col-md-3 footer-links">
                <h3 class="text-capitalize"><?= $record['mn_txt'] ?></h3>
                <ul class="footer_block-nav">
                    <?php foreach ($_mnrecord as $childRecord): ?>
                    <?php if ($childRecord['parent'] == $record['mn_id']): ?>
                    <li><i class="bi bi-chevron-right"></i><a target="<?= $childRecord['mn_tar'] ?>"
                            href="<?= $footer_url . $childRecord['mn_url'] ?>"
                            class="text-capitalize"><?= $childRecord['mn_txt'] ?></a></li>
                    <?php foreach ($_mnrecord as $endChild): ?>
                    <ul class="list-unstyled">
                        <?php if ($endChild['parent'] == $childRecord['mn_id']): ?>
                        <li><i class="bi bi-chevron-right"></i><a target="<?= $record['mn_tar'] ?>"
                                href="<?= $footer_url . $childRecord['mn_url'] ?>"
                                class="text-capitalize"><?= $endChild['mn_txt'] ?></a></li>
                        <?php endif ?>
                    </ul>
                    <?php endforeach ?>
                    <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>
            <?php endforeach; ?>

            <!-- <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h4>Follow Us</h4>
                <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                <div class="social-links d-flex">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div> -->

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $_profile[0]['prof_lnm']?></strong> <span>All
                Rights Reserved</span>
        </p>
    </div>

</footer>
<?php 
   $profile = $mysqli->query('SELECT prof_lnm, prof_snm, prof_lg from pub_profile');
   $_profile = $profile->fetch_all(MYSQLI_ASSOC);

   $current_page = $_SERVER['REQUEST_URI'];
$url_root = ($current_page === '') ? '' : '../';

?>



<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="images/profile/<?= $_profile[0]['prof_lg']?>" alt="">
            <h6 class="sitename align-items-center mt-2"><?= $_profile[0]['prof_lnm']?><br>
                Kabupaten Sidoarjo</h6>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="">Beranda</a></li>
                <!-- LOOP FOR MENU NAVBAR -->
                <?php
    // Get menu data from database
    $result = $mysqli->query('SELECT * from set_menu WHERE _active=1');
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Call function to display menu
    displayMenu($rows);

    // Function to display menu recursively
    function displayMenu($data, $parent_id = 0)
    {
        foreach ($data as $key => $value) {
            if ($value['parent'] == $parent_id) {
                generateHTML($data, $value);
            }
        }
    }

    function generateHTML($data, $menu)
    {
        $count = 0;

        foreach ($data as $key => $value) {
            if ($value['parent'] == $menu['mn_id']) {
                $count++;
            }
        }

        if ($count > 0) {
            echo '<li class="dropdown">'; 
            echo '<a href="'.$menu['mn_url'].'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu['mn_txt'].' <span class="caret"></span></a>';
            echo '<ul class="dropdown-menu">'; 
            displayMenu($data, $menu['mn_id']); 
            echo '</ul>';
            echo '</li>';
        } else {
            echo '<li><a href="'.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>'; 
        }
    }
?>

                <!-- <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li>
                <li><a href="#contact">Contact</a></li> -->
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="#about"><i class="bi bi-instagram"></i></a>
        <a class="btn-getstarted" href="#about"><i class="bi bi-x"></i></a>
        <a class="btn-getstarted" href="#about"><i class="bi bi-youtube"></i></a>
        <a class="btn-getstarted" href="#about"><i class="bi bi-facebook"></i></a>


    </div>
</header>
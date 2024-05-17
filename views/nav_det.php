<?php 
   $profile = $mysqli->query('SELECT prof_lnm, prof_snm, prof_lg from pub_profile');
   $_profile = $profile->fetch_all(MYSQLI_ASSOC);
?>


<style>
.dropdown-menu {
    padding: 0.3rem 0;
}

.dropdown-menu .dropdown-list {
    padding: 0;
    width: 100%;
    background-color: #fff;
}

.dropdown-menu .dropdown-list .header_nav-list_item {
    margin: 0;
    padding: 0.3rem 1rem;

}

.dropdown-menu .dropdown-list .header_nav-list_item a {
    display: block;
    padding: 0.5rem 0.5rem;
    text-align: left;
}


@media (max-width: 768px) {
    .dropdown-menu .dropdown-list .header_nav-list_item a {
        text-align: center;
    }

    .dropdown-menu .dropdown-list .header_nav-list_item a:hover {
        color: #fff;
    }
}
</style>

<nav class="promobar header " data-page="home">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="logo header_logo">
            <a class="d-inline-flex align-items-center" href="..\index.php">
                <span class="logo_picture">
                    <img src="../images/profile/<?= $_profile[0]['prof_lg']?> ?>" alt="icon" />
                </span>
                <small class="title-short text-uppercase" style="color:white ;">
                    <?= $_profile[0]['prof_snm']?>
                </small>
                <small class="title-long text-uppercase" style="color:white ;">
                    <?= $_profile[0]['prof_lnm']?>
                    <br>
                    Kabupaten Sidoarjo
                </small>
            </a>
        </div>
        <button class="header_trigger" type="button" data-bs-toggle="collapse" data-bs-target="#headerMenu"
            aria-controls="headerMenu">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </button>
        <nav class="header_nav collapse" id="headerMenu">
            <ul class="header_nav-list">
                <li class="header_nav-list_item">
                    <a class="nav-item" href="index.php" data-page="beranda">Beranda</a>
                </li>

                <?php
            // Mendapatkan data menu dari database
            $result = $mysqli->query('SELECT * from set_menu WHERE _active=1');
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            // Memanggil fungsi untuk menampilkan menu
            menu($rows);

            // Fungsi untuk menampilkan menu rekursif
            function menu($data, $parent_id = 0)
            {
                foreach ($data as $key => $value) {
                    if ($value['parent'] == $parent_id) {
                        html($data, $value);
                    }
                }
            }

            function html($data, $menu)
            {
                $count = 0;

                foreach ($data as $key => $value) {
                    if ($value['parent'] == $menu['mn_id']) {
                        $count++;
                    }
                }

                if ($count > 0) {
                    echo '<li class="header_nav-list_item dropdown">'; // Tambahkan class dropdown pada list-item
                    echo '<a class="nav-link nav-item dropdown-toggle d-inline-flex align-items-center" href="'.$menu['mn_url'].'" data-bs-toggle="collapse" data-bs-target="#dropdown_'.$menu['mn_id'].'" data-trigger="dropdown" aria-expanded="false" aria-controls="dropdown_'.$menu['mn_id'].'" data-page="'.$menu['mn_txt'].'">'; // Tambahkan class dan attribute untuk dropdown
                    echo $menu['mn_txt']; // Tampilkan teks menu
                    echo '<i class="icon-angle-down icon"></i>'; // Tampilkan ikon dropdown dengan margin kiri
                    echo '</a>';
                    echo '<div class="dropdown-menu collapse"   id="dropdown_'.$menu['mn_id'].'">'; // Tambahkan id untuk dropdown menu
                    echo '<ul class="dropdown-list dropdown-item nav-item" >'; // Mulai daftar submenu
                    menu($data, $menu['mn_id']); // Panggil fungsi rekursif untuk submenu
                    echo '</ul>';
                    echo '</div>';
                    echo '</li>';
                } else {
                    echo '<li class="header_nav-list_item"><a class="dropdown-item nav-item" target="'.$menu['mn_tar'].'" href="'.$menu['mn_url'].'">'.$menu['mn_txt'].'</a></li>'; // Tampilkan item menu biasa
                }

            }
        ?>
            </ul>
        </nav>


    </div>
</nav>
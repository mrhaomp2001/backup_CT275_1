<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

$user = new TaiKhoanNguoiDung($pdo);
$user = $user->FindByUsername($_SESSION["username"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>Lỗi 404 - Hội Học thuật</title>

    <link href="/src/views/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/src/views/assets/css/fontawesome.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/templatemo-cyborg-gaming.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/owl.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" type="text/css" />
</head>


<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <?php
    require ROOT_DIR . "/src/views/header/header.php";
    ?>
    <!-- ***** Header Area End ***** -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <!-- ***** Banner Start ***** -->
                    <div class="main-banner" style="background-image: url(/src/views/assets/images/banner-bg.jpg)">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="header-text">
                                    <h6>Chào mừng bạn</h6>
                                    <h4>Đến với <br><em> Lỗ đen vũ trụ</em> </h4>
                                    <div class="main-button">
                                        <a href="/study">Trở về lớp học</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->

                    <div class="most-popular">
                        <div class="row">
                            <div class="col-lg-12 text-light">
                                <h3>Ôi không! Bạn đang trong khu vực nguy hiểm!</h3>
                                <br>
                                <h5>Bạn đang tiếp cận 1 lỗ đen, bạn đang làm gì ở đây vậy? Hãy mau quay về lớp học.</h5>
                                <br>...
                                <br> Tôi đang dần mất kết nối với bạn...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>...
                                <br>
                                <h3><a href="https://youtu.be/a8Wdta9YFYk">...</a></h3>
                                <br>...


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved.

                        <br />Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a> Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
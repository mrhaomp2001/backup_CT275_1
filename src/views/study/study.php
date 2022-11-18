<?php

require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

$user = new TaiKhoanNguoiDung($pdo);
$user = $user->FindByUsername($_SESSION["username"]);

$noiDungSauTraLoi;
$CauTraLoiDung;


if ($_SESSION['isStudy'] == 0) {
    Redirection("/study");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SESSION['username']) && !empty($_POST['maCauTraLoi'])) {

        $query = 'CALL SELECTCAUTRALOIBYUSERNAME(?, ?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $user->username,
                $user->maCauHoi,
                $_POST['maCauTraLoi']
            ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }

        while ($row = $sth->fetch()) {
            $noiDungSauTraLoi = $row['NOI_DUNG_SAU_TRA_LOI'];
            $CauTraLoiDung = $row['CAU_TRA_LOI_DUNG'];
        }

        echo $noiDungSauTraLoi . ' >> ' . $CauTraLoiDung;
        $_SESSION['isStudy'] = 0;
    } else {
        echo 'gõ vô tài khoản và mật khẩu';
        Redirection("/study");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>Xử lý học tập - Hội Học thuật</title>


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
    <!-- 
    ***** Header Area End ***** -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <!-- ***** Most Popular Start ***** -->
                    <div class="feature-banner ">
                        <div class="row">
                            <div class="col-lg-12 text-light">
                                <?php
                                if ($CauTraLoiDung == 1) {
                                    echo '<h4 class="text-center">Bạn đã đúng!</h4> <br>';
                                } else {
                                    echo '<h4 class="text-center">Bạn đã sai</h4> <br>';
                                }
                                echo $noiDungSauTraLoi;
                                ?>
                                <div style="height: 25px; width: 50px; text-align:center"></div>
                                <div class="main-button text-center">
                                    <a href="/study">Tiếp tục học</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Most Popular End ***** -->
                    <hr class="text-light">

                    <!-- ***** Banner Start ***** -->
                    <div class="main-banner" style="background-image: url(/src/views/assets/images/banner-bg.jpg)">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="header-text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->

                </div>
            </div>
        </div>
    </div>

    <?php
    require ROOT_DIR . "/src/views/header/footer.php";
    ?>

</body>

</html>
<?php
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

$user = new TaiKhoanNguoiDung($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = '';

    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name'])) {
        $user = $user->FindByUsername($_POST['username']);
        if (empty($user->username)) {
            $query = 'CALL REGISTER(?, ?, ?)';

            try {
                $sth = $pdo->prepare($query);
                $sth->execute([
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['name']
                ]);
            } catch (PDOException $e) {
                $pdo_error = $e->getMessage();
            }

            if ($sth && $sth->rowCount() == 1) {
            } else {
                echo 'Lỗi';
                echo 'Không rõ nguyên nhân';
            }
        } else {
            $result = 'Tài khoản đã có người dùng, hãy dùng một tên tài khoản khác';
        }
    } else {
        echo 'gõ vô tài khoản và mật khẩu';
    }
}
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>Cyborg - Awesome HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/src/views/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/src/views/assets/css/fontawesome.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/templatemo-cyborg-gaming.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/owl.css" type="text/css" />
    <link rel="stylesheet" href="/src/views/assets/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" type="text/css" />
</head>
<?php
require ROOT_DIR . "/src/views/header/header.php";
?>

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

    <!-- ***** Header Area End ***** -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="most-popular">
                        <div class="row">
                            <p class="text-center text-light">
                                <?php
                                echo $result;
                                ?>
                            <div class="main-button">
                                <a href="/register">Đăng ký lại</a>
                            </div>
                            </p>
                        </div>
                        <div style=" width:50px; height:50px"></div>
                    </div>
                    <!-- ***** Most Popular End ***** -->
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
<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

if (!empty($_SESSION["username"])) {
    $user = new TaiKhoanNguoiDung($pdo);
    $user = $user->FindByUsername($_SESSION["username"]);
} else {
    Redirection('/login');
}

if ($user->maLoaiTaiKhoan <= 1) {
    Redirection('/login');
}

$notice = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['questionContent']) && !empty($_POST['money']) && !empty($_POST['exp'])) {

        $query = 'call ADDCAUHOI(?, ?, ?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maLop'],
                $_POST['questionContent'],
                $_POST['money'],
                $_POST['exp']
            ]);
            Redirection('/adminClasses');
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
    } else {
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>Cyborg - Awesome HTML5 Template</title>

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
                    <h4 class="mb-3">Tạo câu hỏi mới</h4>
                    <!-- ***** Banner Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile ">
                                <div class="row">
                                    <h4 class="mb-3"><?php echo $_POST['className']; ?></h4>

                                    <h3 class="text-center">
                                        <?php
                                        echo $notice;
                                        ?>
                                    </h3>
                                    <div style="height: 15px; width: 50px; text-align:center"></div>
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <form action="#" method="post" class="w-100">
                                            <div class="mb-3">
                                                <label class="form-label text-light">Nội dung câu hỏi</label>
                                                <textarea class="form-control" name="questionContent" maxlength="256" placeholder="Nhập nội dung câu hỏi"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Tiền người học nhận được khi đúng</label>
                                                <input type="number" class="form-control" name="money" min="1" max="900"  placeholder="Nhập tiền">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Kinh nghiệm người học nhận được khi đúng</label>
                                                <input type="number" class="form-control" name="exp" min="1" max="900" placeholder="Nhập kinh nghiệm">
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <h5>Tạo câu hỏi mới</h5>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->
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
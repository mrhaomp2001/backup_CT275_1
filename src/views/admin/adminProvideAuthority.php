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

if ($user->maLoaiTaiKhoan <= 2) {
    Redirection('/login');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['loaiTaiKhoan']) && ($_POST['username'] != $_SESSION['username'])) {

        $query = 'call UPDATEMODERATOR(?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_POST['username'],
                $_POST['loaiTaiKhoan']
            ]);
            Redirection('/adminProvideAuthority');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        Redirection('/adminProvideAuthority');
    }
}

$listUser = new TaiKhoanNguoiDung($pdo);

$list = array();

$list = $listUser->FindByUsernameMODERATOR();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>HR - Hội Học thuật</title>

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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading-section">
                                <h2>Thêm quản trị viên</h2>
                                <form action="#" method="post">
                                    <div class="mb-3">
                                        <label class="form-label text-light">Tài khoản của quản trị viên</label>
                                        <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản của quản trị viên để thêm">
                                        <input type="hidden" name="loaiTaiKhoan" value="2">
                                    </div>
                                    <button type="submit" class="btn btn-cyborg my-3"> + Thêm quản trị viên</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                        </div>
                    </div>

                    <hr class="text-light">

                    <!-- ***** Other Start ***** -->
                    <div class="other-games">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading-section">
                                    <h4 class="text-light">Tất cả các quản trị viên</h4>
                                </div>
                            </div>
                            <?php
                            for ($i = 0; $i < count($list); $i++) {
                                echo '              
                    <div class="col-lg-6">
                      <form action="#" method="post">
                        <div class="item">
                          <input type="hidden" name="username" value="' . $list[$i]->username . '">
                          <input type="hidden" name="loaiTaiKhoan" value="1">

                          <h4>' . $list[$i]->tenNguoiDung . '</h4>
                          <p>a.k.a ' . $list[$i]->username . '</p>
                          <ul>
                            <li>
                              <button type="submit" class="btn btn-cyborg text-end">Xóa quyền</button>
                            </li>
                          </ul>
                        </div>
                      </form>
                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- ***** Other End ***** -->
                </div>

                <!-- ***** Most Popular End ***** -->

            </div>
        </div>
    </div>
    </div>

    <?php
    require ROOT_DIR . "/src/views/header/footer.php";
    ?>

</body>

</html>
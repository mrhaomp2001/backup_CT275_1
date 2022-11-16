<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;
use MagicClass\CauHoi;


if (!empty($_SESSION["username"])) {
    $user = new TaiKhoanNguoiDung($pdo);
    $user = $user->FindByUsername($_SESSION["username"]);
} else {
    Redirection('/404');
}

if ($user->maLoaiTaiKhoan <= 1) {
    Redirection('/login');
}

$notice = '';

$listQuestion = array();

$cauHoi = new CauHoi($pdo);

if (!empty($_POST['maLop'])) {
    $_SESSION['maLop'] = $_POST['maLop'];
    $listQuestion = $cauHoi->GetByMaLop($_SESSION['maLop']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['classNameEdit']) && !empty($_POST['classDescriptionEdit'])) {

        $query = 'call UPDATELOPHOC(?, ?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maLop'],
                $_POST['classNameEdit'],
                $_POST['classDescriptionEdit']
            ]);
            Redirection('/adminClasses');
        } catch (PDOException $e) {
        }
    } else {
    }

    if (!empty($_POST['deleteLopHoc'])) {

        $query = 'call DELETELOPHOC(?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maLop']
            ]);
            Redirection('/adminClasses');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
                    <div class="row">
                        <h1><?php echo $_SESSION['tenLop']; ?></h1>
                        <h4 class="mb-3 mt-3">Chỉnh sửa lớp học</h4>
                        <div class="col-lg-12">
                            <div class="main-profile ">
                                <div class="row">
                                    <h3 class="text-center">
                                        <?php
                                        echo $notice;
                                        ?>
                                    </h3>
                                    <div style="height: 15px; width: 50px; text-align:center"></div>


                                    <form action="#" method="post" id="loginForm" class="w-100">
                                        <div class="mb-3">
                                            <label class="form-label text-light">Tên lớp</label>
                                            <input type="text" class="form-control" name="classNameEdit" maxlength="128" placeholder="Nhập tên lớp" value="<?php echo $_POST['className']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-light">Miêu tả</label>
                                            <textarea class="form-control" name="classDescriptionEdit" maxlength="256" placeholder="Nhập miêu tả" rows="5"><?php echo $_POST['classDescription']; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <h5>Chỉnh sửa</h5>
                                        </button>
                                    </form>
                                </div>
                                <hr class="text-light">
                                <div class="col-lg-12">
                                    <h4>Xóa lớp học</h4>

                                    <p class="text-warning">Xin hãy chắc rằng bạn đã <b>xóa hết tất cả</b> các câu hỏi trong lớp trước khi thực hiện xóa.</p>
                                    <p class="text-danger">Lưu ý, khi thực hiện xóa thành công, lớp học sẽ không thể khôi phục.</p>
                                    <form action="#" method="post">
                                        <input type="hidden" name="deleteLopHoc" value="1">
                                        <button type="submit" class="btn btn-danger mx-3 w-25">
                                            <h6>Xóa câu trả lời</h6>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="text-light mt-5">
                    <h4 class="mb-2 mt-3 row justify-content-between">
                        <div class="col-6">Các câu hỏi</div>
                        <div class="col-6 text-end">
                            <form action="/adminQuestionsAdd" method="post">
                                <input type="hidden" name="className" value="<?php echo $_POST['className']; ?>">
                                <button class="btn btn-cyborg">+ Thêm câu hỏi</button>
                            </form>
                        </div>
                    </h4>
                    <div class="col-12">
                        <div class="main-profile">
                            <?php
                            for ($i = 0; $i < count($listQuestion); $i++) {
                                echo
                                '
                                    <div class="col-lg-12 mb-3 mt-3">
                                        <div class="left-info text-light">
                                            <ul>
                                                <form action="/adminQuestionsEdit" method="post" class="row">
                                                <li class="text-light">' . $listQuestion[$i]->noiDungCauHoi . '</li>
                                                <li class="text-light">
                                                    <input type="hidden" name="className" value="' . $_POST['className'] . '">
                                                    <input type="hidden" name="maCauHoi" value="' . $listQuestion[$i]->maCauHoi . '">
                                                    <input type="hidden" name="noiDungCauHoi" value="' . $listQuestion[$i]->noiDungCauHoi . '">
                                                    <input type="hidden" name="tien" value="' . $listQuestion[$i]->tienCauHoi . '">
                                                    <input type="hidden" name="kinhNghiem" value="' . $listQuestion[$i]->kinhNgiem . '">
                                                    <button type="submit" class="btn btn-secondary mx-3">
                                                    <h6>Chỉnh sửa</h6>
                                                        </button>
                                                        <class="text-light">
                                                            Tiền: ' . $listQuestion[$i]->tienCauHoi . ' - Kinh nghiệm: ' . $listQuestion[$i]->kinhNgiem . '
                                                        </>
                                                </li>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                    ';
                            }
                            ?>
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
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['maCauHoi'])) {
        $_SESSION['maCauHoi'] = $_POST['maCauHoi'];
        $_SESSION['noiDungCauHoi'] = $_POST['noiDungCauHoi'];
        $_SESSION['tien'] = $_POST['tien'];
        $_SESSION['kinhNghiem'] = $_POST['kinhNghiem'];
    }

    if (!empty($_POST['questionContent']) && !empty($_POST['money']) && !empty($_POST['exp']) && !empty($_SESSION['maCauHoi'])) {

        $query = 'call UPDATECAUHOI(?, ?, ?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maCauHoi'],
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

    if (!empty($_POST['delete']) && !empty($_SESSION['maCauHoi'])) {

        $query = 'call DELETECAUHOI(?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maCauHoi']
            ]);
            Redirection('/adminClasses');
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
    }

    if (!empty($_POST['deleteCauTraLoi']) && $_POST['deleteCauTraLoi'] == 1) {
        $query = 'call DELETECAUTRALOI(?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_POST['maCauTraLoi']
            ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
    }
}

use MagicClass\CauTraLoi;

$list = array();

$cauTraLoi = new CauTraLoi();
$cauTraLoi->db = $pdo;
$list = $cauTraLoi->GetByMaCauHoi($_SESSION['maCauHoi']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <title>Chỉnh sửa câu hỏi - Hội Học thuật</title>

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
                    <h4 class="mb-3">Chỉnh sửa câu hỏi</h4>
                    <!-- ***** Banner Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile ">
                                <div class="row">
                                    <h4 class="mb-3"><?php echo $_SESSION['tenLop']; ?></h4>
                                    <h3 class="text-center">
                                    </h3>
                                    <div style="height: 15px; width: 50px; text-align:center"></div>
                                    <div class="row col-lg-12 d-flex justify-content-center">
                                        <form action="#" method="post" class="col-12 w-100" id="form">
                                            <div class="mb-3">
                                                <label class="form-label text-light">Nội dung câu hỏi</label>
                                                <textarea class="form-control" name="questionContent" maxlength="256" placeholder="Nhập nội dung câu hỏi"><?php echo $_SESSION['noiDungCauHoi']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Tiền người học nhận được khi đúng</label>
                                                <input type="number" class="form-control" name="money" min="1" max="900" placeholder="Nhập tiền" value="<?php echo $_SESSION['tien']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Kinh nghiệm người học nhận được khi đúng</label>
                                                <input type="number" class="form-control" name="exp" min="1" max="900" placeholder="Nhập kinh nghiệm" value="<?php echo $_SESSION['kinhNghiem']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <h5>Thay đổi</h5>
                                            </button>
                                        </form>
                                        <hr class="text-light">
                                        <form action="#" method="post" class="col-12 w-100">
                                            <h4>Bạn muốn xóa câu hỏi?</h4>
                                            <p>Bạn chắc chứ?</p>
                                            <input type="hidden" name="delete" value="1">
                                            <button type="submit" class="btn btn-danger mt-3">
                                                <h5 class="">Xóa câu hỏi</h5>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ***** Banner End ***** -->
                    <div class="row py-3">
                        <div class="main-profile">
                            <h4 class="mb-3">Các câu trả lời</h4>
                            <div class="col-12 text-end">
                                <a href="/adminAnswerAdd" class="btn btn-cyborg">+ Thêm câu trả lời</a>
                            </div>
                            <?php
                            for ($i = 0; $i < count($list); $i++) {

                                $isCorrect = '';

                                ($list[$i]->cauTraLoiDung == 1)
                                    ? $isCorrect = '<p class="text-success">Đây là câu trả lời đúng</p>'
                                    : $isCorrect = '<p class="text-warning">Đây là câu trả lời sai</p>';

                                echo
                                '
                                <div class="col-lg-12 mb-3 mt-3">
                                    <div class="left-info text-light">
                                        <ul class="row list-inline">
                                            <li> <h4 class="text-light"> Câu trả lời: ' . $list[$i]->noiDungTraLoi . ' ' . $isCorrect . ' </h4></li>
                                            <li class="text-light list-inline-item">
                                                <form action="/adminAnswerEdit" method="post" >
                                                    <input type="hidden" name="maCauTraLoiT" value="' . $list[$i]->maCauTraLoi . '">
                                                    <input type="hidden" name="noiDungTraLoiT" value="' . $list[$i]->noiDungTraLoi . '">
                                                    <input type="hidden" name="noiDungSauTraLoiT" value="' . $list[$i]->noiDungSauTraLoi . '">
                                                    <input type="hidden" name="cauTraLoiDungT" value="' . $list[$i]->cauTraLoiDung . '">

                                                    <button type="submit" class="btn btn-secondary mx-3 w-25">
                                                        <h6>Chỉnh sửa</h6>
                                                    </button>
                                                </form>
                                            
                                                <form action="#" method="post">
                                                    <input type="hidden" name="deleteCauTraLoi" value="1">
                                                    <input type="hidden" name="maCauTraLoi" value="' . $list[$i]->maCauTraLoi . '">
                                                    <button type="submit" class="btn btn-danger mx-3 w-25">
                                                        <h6>Xóa câu trả lời</h6>
                                                    </button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require ROOT_DIR . "/src/views/header/footer.php";
    ?>

    <script type="text/javascript" src="/src/views/vendor/jquery/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#form").validate({
                rules: {
                    questionContent: {
                        required: true,
                    },
                    money: {
                        required: true,
                        min: 1,
                    },
                    exp: {
                        required: true,
                        min: 1,
                    }
                },
                messages: {
                    questionContent: {
                        required: "Bạn chưa nhập tên đăng nhập",
                    },
                    money: {
                        required: "Bạn chưa nhập mật khẩu",
                        min: "Bạn chưa nhập đúng số lượng (ít nhất là 1)",
                    },
                    exp: {
                        required: "Bạn chưa nhập mật khẩu",
                        min: "Bạn chưa nhập đúng số lượng (ít nhất là 1)",
                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback-element text-light");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
            });
        });
    </script>
</body>

</html>
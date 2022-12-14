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

    <title>Ch???nh s???a c??u h???i - H???i H???c thu???t</title>

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
                    <h4 class="mb-3">Ch???nh s???a c??u h???i</h4>
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
                                                <label class="form-label text-light">N???i dung c??u h???i</label>
                                                <textarea class="form-control" name="questionContent" maxlength="256" placeholder="Nh???p n???i dung c??u h???i"><?php echo $_SESSION['noiDungCauHoi']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Ti???n ng?????i h???c nh???n ???????c khi ????ng</label>
                                                <input type="number" class="form-control" name="money" min="1" max="900" placeholder="Nh???p ti???n" value="<?php echo $_SESSION['tien']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Kinh nghi???m ng?????i h???c nh???n ???????c khi ????ng</label>
                                                <input type="number" class="form-control" name="exp" min="1" max="900" placeholder="Nh???p kinh nghi???m" value="<?php echo $_SESSION['kinhNghiem']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <h5>Thay ?????i</h5>
                                            </button>
                                        </form>
                                        <hr class="text-light">
                                        <form action="#" method="post" class="col-12 w-100">
                                            <h4>B???n mu???n x??a c??u h???i?</h4>
                                            <p>B???n ch???c ch????</p>
                                            <input type="hidden" name="delete" value="1">
                                            <button type="submit" class="btn btn-danger mt-3">
                                                <h5 class="">X??a c??u h???i</h5>
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
                            <h4 class="mb-3">C??c c??u tr??? l???i</h4>
                            <div class="col-12 text-end">
                                <a href="/adminAnswerAdd" class="btn btn-cyborg">+ Th??m c??u tr??? l???i</a>
                            </div>
                            <?php
                            for ($i = 0; $i < count($list); $i++) {

                                $isCorrect = '';

                                ($list[$i]->cauTraLoiDung == 1)
                                    ? $isCorrect = '<p class="text-success">????y l?? c??u tr??? l???i ????ng</p>'
                                    : $isCorrect = '<p class="text-warning">????y l?? c??u tr??? l???i sai</p>';

                                echo
                                '
                                <div class="col-lg-12 mb-3 mt-3">
                                    <div class="left-info text-light">
                                        <ul class="row list-inline">
                                            <li> <h4 class="text-light"> C??u tr??? l???i: ' . $list[$i]->noiDungTraLoi . ' ' . $isCorrect . ' </h4></li>
                                            <li class="text-light list-inline-item">
                                                <form action="/adminAnswerEdit" method="post" >
                                                    <input type="hidden" name="maCauTraLoiT" value="' . $list[$i]->maCauTraLoi . '">
                                                    <input type="hidden" name="noiDungTraLoiT" value="' . $list[$i]->noiDungTraLoi . '">
                                                    <input type="hidden" name="noiDungSauTraLoiT" value="' . $list[$i]->noiDungSauTraLoi . '">
                                                    <input type="hidden" name="cauTraLoiDungT" value="' . $list[$i]->cauTraLoiDung . '">

                                                    <button type="submit" class="btn btn-secondary mx-3 w-25">
                                                        <h6>Ch???nh s???a</h6>
                                                    </button>
                                                </form>
                                            
                                                <form action="#" method="post">
                                                    <input type="hidden" name="deleteCauTraLoi" value="1">
                                                    <input type="hidden" name="maCauTraLoi" value="' . $list[$i]->maCauTraLoi . '">
                                                    <button type="submit" class="btn btn-danger mx-3 w-25">
                                                        <h6>X??a c??u tr??? l???i</h6>
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
                        required: "B???n ch??a nh???p t??n ????ng nh???p",
                    },
                    money: {
                        required: "B???n ch??a nh???p m???t kh???u",
                        min: "B???n ch??a nh???p ????ng s??? l?????ng (??t nh???t l?? 1)",
                    },
                    exp: {
                        required: "B???n ch??a nh???p m???t kh???u",
                        min: "B???n ch??a nh???p ????ng s??? l?????ng (??t nh???t l?? 1)",
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
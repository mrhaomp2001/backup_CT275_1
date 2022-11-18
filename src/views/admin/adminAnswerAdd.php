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

if (empty($_SESSION['maCauHoi'])) {
    Redirection('/adminClasses');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['noiDungTraLoi']) && !empty($_POST['noiDungSauTraLoi'])) {

        $isCorrect = (isset($_POST['isCorrect'])) ? 1 : 0;

        $query = 'call ADDCAUTRALOI(?, ?, ?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $_SESSION['maCauHoi'],
                $_POST['noiDungTraLoi'],
                $_POST['noiDungSauTraLoi'],
                $isCorrect
            ]);
            Redirection('/adminQuestionsEdit');
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

    <title>Thêm câu trả lời - Hội Học thuật</title>

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
                    <h4 class="mb-3">Tạo câu trả lời</h4>
                    <!-- ***** Banner Start ***** -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-profile ">
                                <div class="row">
                                    <h4 class="mb-3">Câu hỏi: <?php echo $_SESSION['noiDungCauHoi']; ?></h4>

                                    <h3 class="text-center">
                                        <?php
                                        echo $notice;
                                        ?>
                                    </h3>
                                    <div style="height: 15px; width: 50px; text-align:center"></div>
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <form action="#" method="post" class="w-100">
                                            <div class="mb-3">
                                                <label class="form-label text-light">Nội dung câu trả lời</label>
                                                <textarea class="form-control" name="noiDungTraLoi" maxlength="256" placeholder="Nhập nội dung câu trả lời"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Nội dung hiển thị sau khi chọn đáp án</label>
                                                <textarea class="form-control" name="noiDungSauTraLoi" maxlength="256" placeholder="Nhập nội dung hiển thị sau khi chọn đáp án này, nội dung này sẽ được hiển thị ngay sau khi đáp án được chọn"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label text-light">Đây là câu trả lời đúng? </label>
                                                <input type="checkbox" class="form-check-input" name="isCorrect">
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

    <?php
    require ROOT_DIR . "/src/views/header/footer.php";
    ?>

    <script type="text/javascript" src="/src/views/vendor/jquery/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#form").validate({
                rules: {
                    noiDungTraLoi: {
                        required: true,
                    },
                    noiDungSauTraLoi: {
                        required: true,
                    },
                },
                messages: {
                    noiDungTraLoi: {
                        required: "Trường này là bắt buộc",
                    },
                    noiDungSauTraLoi: {
                        required: "Trường này là bắt buộc",
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
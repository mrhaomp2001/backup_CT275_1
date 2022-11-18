<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;


if (!empty($_SESSION["username"])) {
  $user = new TaiKhoanNguoiDung($pdo);
  $user = $user->FindByUsername($_SESSION["username"]);
} else {
  Redirection('/profile');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['name']) && !empty($_POST['password'])) {

    $query = 'CALL LOGIN(?, ?)';

    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $user->username,
        $_POST['password']
      ]);
    } catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

    if ($sth && $sth->rowCount() == 1) {

      $query = "call CHANGETENNGUOIDUNG(?, ?)";

      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $user->maNguoiDung,
          $_POST['name']
        ]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }


      Redirection('/profile');
    } else {
      echo 'Lỗi';
      $error = 'Không đúng mật khẩu!';
    }
  } else {
    echo 'gõ vô tài khoản và mật khẩu';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <title>Chỉnh sửa thông tin cá nhân - Hội Học thuật</title>

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
          <div class="row">
            <div class="col-lg-12">
              <div class="main-profile ">
                <div class="row">
                  <h3 class="text-center">
                    <?php
                    echo $error;
                    ?>
                  </h3>
                  <div style="height: 15px; width: 50px; text-align:center"></div>
                  <div class="col-lg-12 d-flex justify-content-center">

                    <form action="#" method="post" id="form">
                      <div class="mb-3">
                        <label class="form-label text-light">Tên cần đổi</label>
                        <input type="text" class="form-control" name="name" maxlength="32" placeholder="Nhập tên">
                      </div>
                      <div class="mb-3">
                        <label class="form-label text-light">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" maxlength="32" placeholder="Nhập mật khẩu">
                      </div>
                      <button type="submit" class="btn btn-primary">
                        <h5>Đổi tên</h5>
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
          password: {
            required: true,
            minlength: 5
          },
          name: {
            required: true,
            minlength: 1
          },
        },
        messages: {
          password: {
            required: "Bạn chưa nhập mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 5 ký tự",
          },
          name: {
            required: "Bạn chưa nhập tên",
            minlength: "Tên bạn phải có ít nhất 1 ký tự",
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
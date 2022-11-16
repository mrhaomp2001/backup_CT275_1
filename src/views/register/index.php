<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

if (!empty($_SESSION["username"])) {
  $user = new TaiKhoanNguoiDung($pdo);
  $user = $user->FindByUsername($_SESSION["username"]);
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

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
  <!--

TemplateMo 579 Cyborg Gaming

https://templatemo.com/tm-579-cyborg-gaming

-->
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
          <!-- ***** Banner Start ***** -->
          <div class="main-banner" style="background-image: url(/src/views/assets/images/banner-bg.jpg)">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Welcome To Cyborg</h6>
                  <h4><em>Browse</em> Our Popular Games Here</h4>
                  <div class="main-button">
                    <a href="browse.html">Browse Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
            <div class="row">

              <div class="header-text">
                <h3>Đăng ký tài khoản mới</h3>
              </div>

              <div class="col-lg-12 d-flex justify-content-center">
                <form action="/registerRequest" method="post" id="signupForm">
                  <div class="mb-3">
                    <label class="form-label text-light">Tài khoản</label>
                    <input type="text" class="form-control" name="username" maxlength="32" placeholder="Nhập tài khoản">
                  </div>
                  <div class="mb-3">
                    <label class="form-label text-light">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" maxlength="32" placeholder="Nhập mật khẩu">
                  </div>
                  <div class="mb-3">
                    <label class="form-label text-light">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" name="confirm_password" maxlength="32" placeholder="Nhập mật khẩu">
                  </div>
                  <div class="mb-3">
                    <label class="form-label text-light">Họ tên</label>
                    <input type="text" class="form-control" name="name" maxlength="32" placeholder="Nhập họ tên">
                  </div>
                  <button type="submit" class="btn btn-primary">
                    <h5>Đăng ký</h5>
                  </button>
                </form>
              </div>
            </div>
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

  <script type="text/javascript" src="/src/views/vendor/jquery/jquery.validate.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#signupForm").validate({
        rules: {
          username: {
            required: true,
            minlength: 3
          },
          password: {
            required: true,
            minlength: 5
          },
          confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#password"
          },
          name: {
            required: true,
            minlength: 1
          },
        },
        messages: {
          username: {
            required: "Bạn chưa nhập tên đăng nhập",
            minlength: "Tên đăng nhập phải có ít nhất 3 ký tự",
          },
          password: {
            required: "Bạn chưa nhập mật khẩu",
            minlength: "Mật khẩu phải có ít nhất 5 ký tự",
          },
          confirm_password: {
            required: "bạn chưa nhập mật khẩu",
            minlength: "mật khẩu phải có ít nhất 5 ký tự",
            equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập",
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
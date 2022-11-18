<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

$user = new TaiKhoanNguoiDung($pdo);
$user = $user->FindByUsername($_SESSION["username"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <title>Trang chủ - Hội Học thuật</title>

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
          <div class="main-banner" style="background-image: url(/src/views/assets/images/banner-bg.jpg)">
            <div class="row">
              <div class="col-lg-7">
                <div class="header-text">
                  <h6>Chào mừng bạn</h6>
                  <h4>Đến với <br><em> Hội nghiên cứu <br>học thuật</em> </h4>
                  <div class="main-button">
                    <a href="/study">Học ngay!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Banner End ***** -->

          <!-- ***** Most Popular Start ***** -->
          <div class="most-popular">
            <div class="row">
              <div class="col-lg-12 text-light">
                <?php
                if (!empty($_SESSION['username'])) {
                  if (!empty($_SESSION["user_session_id"])) {
                    echo 'Xin chào ' . $user->tenNguoiDung . '! <br>Hôm nay bạn định học ở đâu?';
                  }
                } else {
                  echo '<p class="text-center text-white">Bạn có tài khoản chưa? Nếu bạn chưa có tài khoản hãy đăng ký ngay để bắt đầu phiêu lưu!</p>';
                  echo '<div class="main-button"> <a href="/register">Đăng ký ngay!</a></div>';
                }
                ?>
              </div>
            </div>
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
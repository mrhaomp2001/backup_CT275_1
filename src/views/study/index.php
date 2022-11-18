<?php
// echo 'home.php';
require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;
use MagicClass\CauHoi;
use MagicClass\CauTraLoi;

if (!empty($_SESSION["username"])) {
  $user = new TaiKhoanNguoiDung($pdo);
  $user = $user->FindByUsername($_SESSION["username"]);
} else {
  Redirection('/login');
}

$cauHoi = new CauHoi($pdo);
$cauHoi = $cauHoi->GetByUsername($_SESSION["username"]);

$cauTraLoi = new CauTraLoi();
$cauTraLoi->db = $pdo;

$cauTraLois = array();

$cauTraLois = $cauTraLoi->getByUsername($_SESSION["username"]);

$_SESSION['isStudy'] = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <title>Học tập - Hội Học thuật</title>

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
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          <!-- ***** Most Popular Start ***** -->
          <div class="feature-banner">
            <div class="row">
              <div class="col-lg-12 text-light">
                <?php
                if (!empty($_SESSION['username'])) {
                  if (!empty($_SESSION["user_session_id"])) {
                    echo $cauHoi->noiDungCauHoi;

                    echo '<div style="height: 25px; width: 50px; text-align:center"></div>';

                    echo '<div class="main-button row justify-content-center"> <hr>';

                    for ($i = 0; $i < count($cauTraLois); $i++) {

                      echo '
                      <form action="/studyRequest" method="post" class="col-12 row">
                        <input type="hidden" name="maCauTraLoi" value="' . $cauTraLois[$i]->maCauTraLoi . '" >
                        <button type="submit" class="btn btn-cyborg col-12 text-break">' . $cauTraLois[$i]->noiDungTraLoi . '</button>
                      </form>
                      ';

                      // echo '<a class="col-md-2 mx-3" href="../study/">1!</a>';
                      echo '<div style="height: 15px; width: 50px; text-align:center"></div>';
                    }
                    echo '</div>';
                  }
                } else {
                  echo '<p class="text-center text-white">Bạn có tài khoản chưa? Nếu bạn chưa có tài khoản hãy đăng ký ngay để bắt đầu phiêu lưu!</p>';
                  echo '<div class="main-button"> <a href="../study/">Đăng ký ngay!</a></div>';
                }

                ?>

              </div>
            </div>
          </div>
          <!-- ***** Most Popular End ***** -->
          <hr class="text-light">

          <!-- ***** Banner Start ***** -->
          <div class="main-banner" style="background-image: url(/src/views/assets/images/banner-bg.jpg)">
            <div class="row">
              <div class="col-lg-6 border rounded bg-stats py-1 ">
                <div class="">
                  <h4>
                    Thông tin: <br>
                  </h4>
                  <em>
                    <h3>
                      <?php echo $user->tenNguoiDung; ?> <br>
                      - Kinh nghiệm: <?php echo $user->kinhNghiem; ?> <br>
                      - Tiền: <?php echo $user->tien; ?> $
                    </h3>
                  </em>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="header-text">
                  <h4>
                    Bạn đang ở <br>
                    <em>
                      <?php echo $user->tenLop; ?>
                    </em>
                  </h4>
                  <div class="main-button">
                    <a href="/classes">Bạn muốn chuyển lớp?</a>
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

</body>

</html>
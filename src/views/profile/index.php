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
$_SESSION['isEditingProfile'] = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <title>Trang cá nhân - Hội Học thuật</title>

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
                  <div class="col-lg-4">
                    <img src="/src/views/assets/images/profile.jpg" alt="" style="border-radius: 23px;">
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <div class="main-info header-text">
                      <h4>
                        <?php
                        echo $user->tenNguoiDung . ' <p style="color: grey">#' . $user->maNguoiDung . ' </p>';
                        ?>
                      </h4>
                      <p>Bạn muốn đổi tên? <br> Hãy ấn vào nút bên dưới nhé</p>
                      <div class="main-border-button">
                        <a href="/editProfile">Đổi tên người dùng</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 align-self-center">
                    <ul>
                      <li>
                        Kinh nghiệm
                        <span><?php echo $user->kinhNghiem; ?></span>
                      </li>
                      <li>
                        Tiền
                        <span><?php echo $user->tien; ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="clips">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="heading-section">
                            <h2>Bạn đang học ở </h2>
                            <h4>
                              <?php echo $user->tenLop; ?>
                            </h4>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="main-button">
                            <a href="/study">Tiếp tục học?!</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="clips">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="heading-section">
                            <h4>Đăng xuất? </h4>
                            <h3>
                              <p>Bạn chắc chứ?</p>
                            </h3>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="main-button">
                            <a href="/logout">Đăng xuất</a>
                          </div>
                        </div>
                      </div>
                    </div>
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
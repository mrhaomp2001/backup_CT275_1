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

use MagicClass\LopHoc;

$lopHocs = new LopHoc();
$lopHocs->db = $pdo;

$list = array();

$list = $lopHocs->GetAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <title>Quản trị lớp học - Hội Học thuật</title>

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
    <div class="col-lg-12">
      <div class="page-content">
        <div class="row">
          <div class="heading-section">
            <h3>
              <?php
              if ($user->maLoaiTaiKhoan == 2) {
                echo 'Thật tuyệt vời! bạn là một <b>Moderator </b>! <br> 
                Bạn có thể chỉnh sửa các lớp học!
                <p> (đây là thông báo gán cứng.) </p>
                ';
              }
              ?>
            </h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="heading-section">
                <h2>Thêm lớp mới</h2>
                <h4>
                  <a href="/adminClassesAdd" class="btn btn-cyborg my-3"> + Thêm lớp học mới</a>
                </h4>
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
                  <h4 class="text-light">Tất cả các lớp học</h4>
                </div>
              </div>
              <?php
              for ($i = 0; $i < count($list); $i++) {
                echo '
                <div class="col-lg-6">
                  <form action="/adminClassesEdit" method="post">
                    <div class="item">
                      <input type="hidden" name="maLop" value="' . $list[$i]->maLop . '">
                      <input type="hidden" name="className" value="' . $list[$i]->tenLop . '">
                      <input type="hidden" name="classDescription" value="' . $list[$i]->mieuTa . '">
                      
                      <img src="/src/views/assets/images/game-01.jpg" alt="" class="templatemo-item">
                      <h4>' . $list[$i]->tenLop . '</h4>
                      <span class="text-break mt-5">' . $list[$i]->mieuTa . '</span>
                      <ul>
                        <li>
                        
                          <button type="submit" class="btn btn-cyborg text-end">Chỉnh sửa</button>
                        </li>
                        <!-- <li><i class="fa fa-download"></i> 2.3M</li> -->
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
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="/" class="logo">
                        <img src="/src/views/assets/images/logo.png" alt="">
                    </a>
                    <ul class="nav">
                        <li><a href="/home">Trang chủ</a></li>
                        <li><a href="/study">Học tập</a></li>
                        <li><a href="/classes">Lớp học</a></li>

                        <?php
                        if (!empty($user->username)) {
                            if ($user->maLoaiTaiKhoan > 1) {
                                echo '<li><a href="/adminClasses" class="btn btn-success text-light px-4">Quản trị</a></li>';
                            }
                            if ($user->maLoaiTaiKhoan > 2) {
                                echo '<li><a href="/adminProvideAuthority" class="btn btn-primary text-light px-4">HR</a></li>';
                            }
                        }
                        ?>

                        <li>
                            <?php
                            if (!empty($user->username)) {
                                echo '<a href="/profile">' . $user->tenNguoiDung . ' <img src="/src/views/assets/images/avatar-02.jpg" alt=""></a>';
                            } else {
                                echo '<a href="/login">Đăng nhập <img src="/src/views/assets/images/avatar-02.jpg" alt=""></a>';
                            }
                            ?>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->

<script src="/src/views/vendor/jquery/jquery.min.js"></script>
<script src="/src/views/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="/src/views/assets/js/isotope.js"></script>
<script src="/src/views/assets/js/owl-carousel.js"></script>
<script src="/src/views/assets/js/tabs.js"></script>
<script src="/src/views/assets/js/popup.js"></script>
<script src="/src/views/assets/js/custom.js"></script>
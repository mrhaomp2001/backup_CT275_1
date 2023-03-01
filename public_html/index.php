<?php

define('ROOT_DIR',  dirname(__DIR__));

$request = $_SERVER['REQUEST_URI'];


//----------------------------------------------------------------
// assets (imgs)
//----------------------------------------------------------------
$assets = '/src/views/assets/';

if (str_contains($request, $assets)) {
    require ROOT_DIR . $request;
}


switch ($request) {
        // Views:
        // Home
    case '/':
    case '/home':
        require ROOT_DIR . '/src/views/home/index.php';
        break;

        // Auth
    case '/login':
        require ROOT_DIR . '/src/views/login/index.php';
        break;
    case '/loginRequest':
        require ROOT_DIR . '/src/views/login/login.php';
        break;
    case '/logout':
        require ROOT_DIR . '/src/views/logout/index.php';
        break;

    case '/register':
        require ROOT_DIR . '/src/views/register/index.php';
        break;
    case '/registerRequest':
        require ROOT_DIR . '/src/views/register/register.php';
        break;

        //profile
    case '/profile':
        require ROOT_DIR . '/src/views/profile/index.php';
        break;
    case '/editProfile':
        require ROOT_DIR . '/src/views/profile/editProfile.php';
        break;

        // Study
    case '/study':
        require ROOT_DIR . '/src/views/study/index.php';
        break;
    case '/studyRequest':
        require ROOT_DIR . '/src/views/study/study.php';
        break;

        // Classes

    case '/classes':
        require ROOT_DIR . '/src/views/classes/index.php';
        break;
    case '/classesRequest':
        require ROOT_DIR . '/src/views/classes/classesRequest.php';
        break;


        //----------------------------------------------------------------
        // ADMIN 
        //----------------------------------------------------------------

        // Classes 
    case '/adminClasses':
        require ROOT_DIR . '/src/views/admin/adminClasses.php';
        break;
    case '/adminClassesAdd':
        require ROOT_DIR . '/src/views/admin/adminClassesAdd.php';
        break;
    case '/adminClassesEdit':
        require ROOT_DIR . '/src/views/admin/adminClassesEdit.php';
        break;
    case '/adminQuestionsAdd':
        require ROOT_DIR . '/src/views/admin/adminQuestionsAdd.php';
        break;
    case '/adminQuestionsEdit':
        require ROOT_DIR . '/src/views/admin/adminQuestionsEdit.php';
        break;
    case '/adminAnswerAdd':
        require ROOT_DIR . '/src/views/admin/adminAnswerAdd.php';
        break;
    case '/adminAnswerEdit':
        require ROOT_DIR . '/src/views/admin/adminAnswerEdit.php';
        break;
    case '/adminProvideAuthority':
        require ROOT_DIR . '/src/views/admin/adminProvideAuthority.php';
        break;
        //----------------------------------------------------------------
        // CSS
        //----------------------------------------------------------------

    case '/src/views/assets/css/fontawesome.css':
        require ROOT_DIR . '/src/views/assets/css/fontawesome.css';
        break;
    case '/src/views/assets/css/templatemo-cyborg-gaming.css':
        require ROOT_DIR . '/src/views/assets/css/templatemo-cyborg-gaming.css';
        break;
    case '/src/views/assets/css/owl.css':
        require ROOT_DIR . '/src/views/assets/css/owl.css';
        break;
    case '/src/views/assets/css/animate.css':
        require ROOT_DIR . '/src/views/assets/css/animate.css';
        break;
    case '/src/views/vendor/bootstrap/css/bootstrap.min.css':
        require ROOT_DIR . '/src/views/vendor/bootstrap/css/bootstrap.min.css';
        break;

    case 'https://unpkg.com/swiper@7/swiper-bundle.min.css':
        require 'https://unpkg.com/swiper@7/swiper-bundle.min.css';
        break;


        //----------------------------------------------------------------
        // JS
        //----------------------------------------------------------------

    case '/src/views/vendor/jquery/jquery.min.js':
        require ROOT_DIR . '/src/views/vendor/jquery/jquery.min.js';
        break;
    case '/src/views/vendor/jquery/jquery.validate.min.js':
        require ROOT_DIR . '/src/views/vendor/jquery/jquery.validate.min.js';
        break;
    case '/src/views/vendor/bootstrap/js/bootstrap.min.js':
        require ROOT_DIR . '/src/views/vendor/bootstrap/js/bootstrap.min.js';
        break;
    case '/src/views/assets/js/isotope.min.js':
        require ROOT_DIR . '/src/views/assets/js/isotope.min.js';
        break;
    case '/src/views/assets/js/isotope.js':
        require ROOT_DIR . '/src/views/assets/js/isotope.js';
        break;
    case '/src/views/assets/js/owl-carousel.js':
        require ROOT_DIR . '/src/views/assets/js/owl-carousel.js';
        break;
    case '/src/views/assets/js/tabs.js':
        require ROOT_DIR . '/src/views/assets/js/tabs.js';
        break;
    case '/src/views/assets/js/popup.js':
        require ROOT_DIR . '/src/views/assets/js/popup.js';
        break;
    case '/src/views/assets/js/custom.js':
        require ROOT_DIR . '/src/views/assets/js/custom.js';
        break;


    default:
        require ROOT_DIR . '/src/views/404/index.php';
        break;
}

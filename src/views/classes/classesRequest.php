<?php

require ROOT_DIR . "/bootstrap.php";

use MagicClass\TaiKhoanNguoiDung;

$user = new TaiKhoanNguoiDung($pdo);
$user = $user->FindByUsername($_SESSION["username"]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SESSION['username']) && !empty($_POST['maLop'])) {

        $query = 'CALL CHANGELOPHOCBYUSERNAME(?, ?)';

        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $user->username,
                $_POST['maLop']
            ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }

        Redirection("/classes");
    } else {
        Redirection("/classes");
    }
}
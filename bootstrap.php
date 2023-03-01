<?php

$_SESSION['isStudy'] = 0;

require 'vendor/autoload.php';

session_start();

if (!isset($_SESSION["username"])) {
    $_SESSION["username"] = "";
}

if (!isset($_SESSION["user_session_id"])) {
    $_SESSION["user_session_id"] = "";
}

function Redirection(string $location)
{
    header('Location: ' . $location);
    exit();
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=hoihocthuat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Không thể kết nối đến CSDL';
    echo $e->getMessage();

    exit();
}

if (!empty($_SESSION['username'])) {
    if (!empty($_SESSION["user_session_id"])) {
        $query = "CALL GET_USER_SESSION_ID(?)";
        $sth = $pdo->prepare($query);

        $sth->execute(
            [
                $_SESSION['username']
            ]
        );

        while ($row = $sth->fetch()) {
            if ($row['USER_SESSION_ID'] != $_SESSION['user_session_id']) {
                $_SESSION["username"] = '';
                $_SESSION["user_session_id"] = '';
                Redirection('/home');
            }
        }

        try {
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
    }
    $sth->closeCursor();
}
echo ' ';

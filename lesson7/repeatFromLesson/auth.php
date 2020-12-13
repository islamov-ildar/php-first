<?php

$auth = false;


if (isset($_GET['logout'])) {
    setcookie('hash', '', time() - 3600, '/');
    unset($_SESSION['login']);
    session_destroy();
    header('Location: index.php');

}

if (is_auth()) {

    $auth = true;
    $user = $_SESSION['login'];
    $name = $user;
}

function is_auth() {

    global $db;
    if(isset($_COOKIE['hash'])) {

        $hash = $_COOKIE['hash'];
        $sql = "SELECT * FROM `users` WHERE `hash` = '{$hash}'";
        $resultHashFromBD = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($resultHashFromBD);
        $user = $row['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
        }
    }
    return isset($_SESSION['login']);
}

function auth($login, $pass) {
    global $db;
    $login = mysqli_real_escape_string($db, strip_tags(stripcslashes($login)));
    $resultLoginFromDB = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '{$login}'");
    $row = mysqli_fetch_assoc($resultLoginFromDB);

    if (password_verify($pass, $row['pass'])) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id_user'];
        return true;
    }
    return false;
}

if ($_POST) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (!auth($login, $pass)) {
        die ('Неверный логин/пароль!');
    } else {
        if (isset($_POST['save'])) {
            $hash = uniqid(rand(), true);
            $id = $_SESSION['id'];
            $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id_user` = '{$id}'";
            $resultHashSet = mysqli_query($db, $sql);
            setcookie('hash', $hash, time()+3600, '/');
        }
        $auth = true;
        $name = $_SESSION['login'];
    }
}
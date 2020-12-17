<?php

$auth = false;


if (isset($_GET['logout'])) {
    setcookie('login', '', time() - 3600, '/');
    header('Location: index.php');

}

if ($_COOKIE['login'] == md5('admin' . 'rgererg4343')) {
    $auth = true;
    $name = 'admin';
}

if ($_POST) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if ($login == 'admin' && $pass == '123') {
        setcookie('login', md5($login .'rgererg4343'), time() + 3600, '/');
        header('Location: index.php');
    }
}
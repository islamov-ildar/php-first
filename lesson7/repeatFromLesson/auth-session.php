<?php
session_start();
$auth = false;


if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');

}

if ($_SESSION['login'] == 'admin') {
    $auth = true;
    $name = 'admin';
}

if ($_POST) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if ($login == 'admin' && $pass == '123') {
        $_SESSION['login'] = $login;
        header('Location: index.php');
    }
}
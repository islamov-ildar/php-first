<?php
session_start();
include 'db.php';
include 'auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<nav>
    <a href="/">Главная страница</a>
    <a href="second.php">Вторая страница</a>
</nav>
<h2>Вторая страница</h2>
<? if ($auth): ?>
    Добро пожаловать <?= $name ?>, <a href="?logout">[Выход]</a>
<? else: ?>
    <form action="" method="post">
        <input type="text" name="login">
        <input type="text" name="pass">
        <input type="submit">
    </form>
<? endif; ?>
</body>
</html>

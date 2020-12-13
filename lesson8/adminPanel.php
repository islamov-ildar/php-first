<?php
session_start();
$sessionId = session_id();

include 'db.php';
include 'library/auth.php';

if ($name != 'admin') die ('Страница доступна только Администратору!');

$result = mysqli_query($db, "SELECT * FROM orders, cart, pictures WHERE orders.session_id = cart.session_id AND cart.product_id = pictures.id");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<? if ($auth): ?>
    Вход выполнен, <?= $name ?> <a href="?logout">[Выход]</a>
<? else: ?>
    Авторизоваться:
    <form action="" method="post">
        <input type="text" name="login">
        <input type="text" name="pass">
        Запомнить меня <input type="checkbox" name="save">
        <input type="submit">
    </form>
<? endif; ?>
<a href="index.php" id="linkBack"><img src="images/60577.png" height="15px" width="20px" style="padding-top:2px" alt="">
    <div>Вернуться на главную</div>
</a><br>
<table>
    <tr>
        <td>Номер заказа</td>
        <td>Имя покупателя</td>
        <td>Номер телефона покупателя</td>
        <td>Количество товара в заказе</td>
        <td>Название товара</td>
    </tr>
    <?while ($row = mysqli_fetch_assoc($result)):?>
        <tr>
            <td><?=$row['id_order']?></td>
            <td><?=$row['nameOfCustomer']?></td>
            <td><?=$row['phoneNumberOfCustomer']?></td>
            <td><?=$row['quantity']?></td>
            <td><?=$row['nameOfProduct']?></td>
        </tr>
    <?endwhile;?>
</table>
</body>
</html>

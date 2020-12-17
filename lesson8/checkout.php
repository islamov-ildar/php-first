<?php
session_start();
$sessionId = session_id();

include 'db.php';
include 'library/auth.php';

$message = [
        'OK' => 'Спасибо за заказ, менеджер свяжется с Вами в ближайшее время! Через 5 секунды Вы будете перенаправлены в каталог!',
        'ERRORNUMBER' => 'Проверьте корректность номера телефона ',
        'ERRORNAMECUSTOMER' => "Проверьте корректность заполения поля 'имя' - оно не должно быть меньше трех символов",
        'ERRORFILLING' => 'Пожалуйста, заполните оба поля'
];


if ($_POST ['nameOfCustomer'] && $_POST ['phoneNumberOfCustomer']) {
    if (mb_strlen($_POST ['phoneNumberOfCustomer']) != 10 && is_numeric($_POST ['phoneNumberOfCustomer'])) {
        header("Location: /checkout.php?message=ERRORNUMBER");
        die;
    }
    if (mb_strlen($_POST ['nameOfCustomer']) <= 2) {
        header("Location: /checkout.php?message=ERRORNAMECUSTOMER");
        exit;
    }
        $nameOfCustomer = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['nameOfCustomer'])));
        $phoneNumberOfCustomer = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['phoneNumberOfCustomer'])));
        $sqlInsert = "INSERT INTO orders (nameOfCustomer, phoneNumberOfCustomer, session_id) VALUES ('{$nameOfCustomer}', '{$phoneNumberOfCustomer}', '{$sessionId}')";
        mysqli_query($db, $sqlInsert);

        header("Location: /checkout.php?message=OK");
} elseif ($_POST ['nameOfCustomer'] || $_POST ['phoneNumberOfCustomer']) {
    header("Location: /checkout.php?message=ERRORFILLING");
    exit;
}

$completeMessage = '';
if ($_GET['message']) {
    $completeMessage = $message[$_GET['message']];
    if ($_GET['message'] == 'OK') {
        session_regenerate_id();
        header('refresh: 5; /');
    }

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оформление заказа</title>
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
<div class="pageName">
    <h3>Оформление заказа</h3>
    <form action="" method="post">
        Введите своё имя:
        <input type="text" placeholder="Иван" name="nameOfCustomer"><br><br>
        Введите свой номер телефона: +7
        <input type="tel" placeholder="999-999-99-99" name="phoneNumberOfCustomer"><br><br>
        <input type="submit" value="Оформить заказ">
    </form>
</div>
<br>
<div><?=$completeMessage?></div>

</body>
</html>

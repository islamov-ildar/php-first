<?php
session_start();
$sessionId = session_id();

include 'db.php';
include 'repeatFromLesson/auth.php';


define("IMG", "images/origin");
define("MINIMG", "images/min");

if ($_GET['action'] == 'delete') {
    $id_cartRecord = (int)$_GET['idProductForDelete'];
    $productQuantityForDelete = mysqli_query($db, "SELECT quantity FROM cart WHERE id_cartRecord = '{$id_cartRecord}'");
    $productQuantityForDelete = mysqli_fetch_array($productQuantityForDelete);
    $productQuantityForDelete = $productQuantityForDelete[0];
    if ($productQuantityForDelete == 1) {
        $sql = "DELETE FROM cart WHERE id_cartRecord = '{$id_cartRecord}'";
        mysqli_query($db, $sql);
        header("Location: /cart.php?message=DELETE&{$id_cartRecord}");
    } else {
        $sqlInsert = "UPDATE cart SET quantity = quantity-1 WHERE id_cartRecord = '{$id_cartRecord}'";
        mysqli_query($db, $sqlInsert);
        header("/cart.php?message=DELETE&{$id_cartRecord}");
    }
}

$result = mysqli_query($db, "SELECT * FROM pictures, cart WHERE session_id = '{$sessionId}' AND cart.product_id=pictures.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Корзина товаров</title>
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
    <h3>Корзина товаров</h3>
    <form action="">
        <input type="submit" value="Перейти к оформлению заказа">
    </form>
</div>
<div class="container">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>

        <div class="cell"><a href="imageViewing.php?id_image=<?= $row['id'] ?>&updateViews=true"><img
                        src="<?= MINIMG . '/' . $row['name'] ?>" alt='somePicture' height='150px'></a><br>
            Название автомобиля: <?= $row['nameOfProduct'] ?><br>
            Стоимость автомобиля: <?= $row['costOfProduct'] ?><br>
            Описание: <?= $row['descriptionOfProduct'] ?><br>
            <b>Количество в корзине: <?= $row['quantity'] ?><br></b>
            <div class="button"><a href="cart.php?action=delete&idProductForDelete=<?= $row['id_cartRecord'] ?>">Удалить
                    товар из корзины</a></div>
        </div>

    <?php endwhile; ?>

    <br>
</div>

</body>
</html>
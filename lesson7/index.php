<?php
session_start();
$sessionId = session_id();

define("IMG", "images/origin");
define("MINIMG", "images/min");
define("TEMPLATES", "templates");

include("library/classSimpleImage.php");
include 'db.php';
include 'repeatFromLesson/auth.php';

$images = scandir(IMG);
$images = array_splice($images, 2);

//Проверка соответствия содержимого директории с изображениями и таблицы изображений
/*$fileSizeInDirectories = null;
$fileSizeInDB = null;
$result = mysqli_query($db, "SELECT * FROM pictures");
while ($row = mysqli_fetch_assoc($result)) {
    $fileSizeInDB += $row['size'];
}
foreach ($images as $key => $value) {
    $fileSize = fileSize(IMG . "/" . $value);
    $fileSizeInDirectories += $fileSize;
}
if ($fileSizeInDirectories != $fileSizeInDB) {
    $sqlClearTablePicture = "TRUNCATE TABLE pictures";
    mysqli_query($db, $sqlClearTablePicture);
    foreach ($images as $key => $value) {
        $fileSize = fileSize(IMG . "/" . $value);
        $sqlInsert = "INSERT INTO pictures (`name`, `size`) VALUES ('$value', '$fileSize')";
        mysqli_query($db, $sqlInsert);
    }
}*/


$message = strip_tags($_GET['message']);

$config = [
    "OK" => "Файл загружен",
    "ERROR" => "Ошибка загрузки файла"
];

function verifyFile()
{
    if ($_FILES["myfile"]["tmp_name"] == null) {
        return false;
    }
    $fileType = substr(mime_content_type($_FILES["myfile"]["tmp_name"]), 0, 5);
    $fileSize = $_FILES["myfile"]["size"];
    if ($fileSize <= 5000000 && $fileType == "image") {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['load'])) {
    $path = "images/origin/" . $_FILES["myfile"]["name"];
    $fileName = $_FILES["myfile"]["name"];
    if (verifyFile() && move_uploaded_file($_FILES["myfile"]["tmp_name"], $path)) {
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToHeight(150);
        $image->save("images/min/" . $fileName);

        $fileSize = fileSize($path);
        $sqlInsert = "INSERT INTO pictures (`name`, `size`) VALUES ('$fileName', '$fileSize')";
        mysqli_query($db, $sqlInsert);

        header("Location: index.php?message=OK");

    } else {
        header("Location: index.php?message=ERROR");
    }
    exit;
}
$result = mysqli_query($db, "SELECT * FROM pictures ORDER BY views DESC");

if (isset($_GET['addToCart'])) {
    $idProductForCart = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_GET['addToCart'])));

    $sqlCheckExistRow = "SELECT id_cartRecord FROM cart WHERE product_id = '{$idProductForCart}' AND session_id = '{$sessionId}'";
    $resultOfCheckingExistRow = mysqli_query($db, $sqlCheckExistRow);
    if (mysqli_num_rows($resultOfCheckingExistRow) == 0) {
        $sqlInsert = "INSERT INTO cart (`session_id`, `product_id`, `quantity`) VALUES ('{$sessionId}', '{$idProductForCart}', '1')";
        mysqli_query($db, $sqlInsert);
        header("Location: index.php");
    } else {
        $sqlInsert = "UPDATE cart SET quantity = quantity+1 WHERE product_id = '{$idProductForCart}' AND session_id = '{$sessionId}'";
        mysqli_query($db, $sqlInsert);
        header("Location: index.php");
    }
}

$quantityInCart = mysqli_query($db, "SELECT SUM(quantity) FROM cart WHERE session_id = '{$sessionId}'");
$quantityInCart = mysqli_fetch_array($quantityInCart);
$quantityInCart = $quantityInCart[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
<div class="pageName">
    <h3><a href="index.php">Главная</a><br></h3>
</div>

<a href="cart.php"><div class="cart">Корзина (<?= $quantityInCart ?>)</div></a>

<div class="container">
<?php while ($row = mysqli_fetch_assoc($result)): ?>

    <div class="cell"><a href="imageViewing.php?id_image=<?= $row['id'] ?>&updateViews=true"><img
                    src="<?= MINIMG . '/' . $row['name'] ?>" alt='somePicture' height='150px'></a><br>
        Название автомобиля: <?= $row['nameOfProduct'] ?><br>
        Стоимость автомобиля: <?= $row['costOfProduct'] ?><br>
        <a href="/?addToCart=<?= $row['id'] ?>"><div class="button">Добавить в корзину</div></a>
    </div>
<?php endwhile; ?>
</div>


<!--
<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="myfile">
    <input type="submit" name="load" value="Загрузить картинку">
</form>
-->
</body>
</html>



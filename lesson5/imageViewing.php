<?php

include 'db.php';
define("IMG", "images/origin");

$id = (int)$_GET['id'];
mysqli_query($db, "UPDATE pictures SET views = views+1 WHERE id = {$id}");
$result = mysqli_query($db, "SELECT * FROM pictures WHERE id = {$id}");

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="index.php">Вернуться на главную</a><br>
<img src="<?=IMG.'/'.$row['name']?>" alt='somePicture' height="400px"><br>
Количество просмотров: <?=$row['views']?>
</body>
</html>
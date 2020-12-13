<?php

include 'db.php';

$id = (int)$_GET['id'];

$result = mysqli_query($db, "SELECT * FROM news WHERE id = {$id}");

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2><?=$row['title']?></h2>
<p><?=$row['text']?></p>
</body>
</html>
<?php

define("IMG", "images/origin");
define("MINIMG", "images/min");
define("TEMPLATES", "templates");

include("library/classSimpleImage.php");
include 'db.php';


$images = scandir(IMG);
$images = array_splice($images, 2);

//Проверка соответствия содержимого директории с изображениями и таблицы изображений
$fileSizeInDirectories = null;
$fileSizeInDB = null;
$result = mysqli_query($db, "SELECT * FROM pictures");
while ($row = mysqli_fetch_assoc($result)) {
    $fileSizeInDB += $row['size'];
}
foreach ($images as $key => $value){
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
}


$message = strip_tags($_GET['message']);

$config = [
    "OK" => "Файл загружен",
    "ERROR" => "Ошибка загрузки файла"
];

function verifyFile() {
    if ($_FILES["myfile"]["tmp_name"] == null){
        return false;
    }
    $fileType = substr(mime_content_type($_FILES["myfile"]["tmp_name"]), 0, 5);
    $fileSize = $_FILES["myfile"]["size"];
    if($fileSize <= 5000000 && $fileType == "image") {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['load'])) {
    $path = "images/origin/" . $_FILES["myfile"]["name"];
    $fileName = $_FILES["myfile"]["name"];
    if(verifyFile() && move_uploaded_file($_FILES["myfile"]["tmp_name"], $path) ) {
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToHeight(150);
        $image->save("images/min/".$fileName);

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php while ($row = mysqli_fetch_assoc($result)): ?>

    <a href="imageViewing.php?id=<?= $row['id'] ?>"><img src="<?=MINIMG.'/'.$row['name']?>" alt='somePicture' height='150px'></a>

<?php endwhile; ?>

<form action="" enctype="multipart/form-data" method="post">
    <input type="file" name="myfile">
    <input type="submit" name="load" value="Загрузить картинку">
</form>

<?php
echo $config[$message];
?>
</body>
</html>



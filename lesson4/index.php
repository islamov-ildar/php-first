<?php

define("IMG", "images/origin");
define("MINIMG", "images/min");
define("TEMPLATES", "templates");

include("library/classSimpleImage.php");

$images = scandir(IMG);
$images = array_splice($images, 2);

$message = strip_tags($_GET['message']);

$config = [
    "OK" => "Файл загружен",
    "ERROR" => "Ошибка загрузки файла"
];

function galleryRender($imagesArr, $imgLink, $imgMinLink) {
    $result = null;
    foreach ($imagesArr as $key => $value) {
        $result .= "<a href=$imgLink/$value target='_blank'><img src=$imgMinLink/$value alt='somePicture' height='150px'></a>";
    }
    return $result;
}

function verifyFile() {
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
        header("Location: index.php?message=OK");

    } else {
        header("Location: index.php?message=ERROR");
    }
    exit;
}

include_once "TEMPLATES" . "/template1.html";



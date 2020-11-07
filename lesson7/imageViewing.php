<?php
session_start();
$sessionId = session_id();

include 'db.php';

define("IMG", "images/origin");

$id_image = (int)$_GET['id_image'];

$updateViews = (bool)$_GET['updateViews'];

if ($updateViews == true) {
    mysqli_query($db, "UPDATE pictures SET views = views+1 WHERE id = {$id_image}");
}
$updateViews = false;
$_GET['$updateViews'] = false;

$result = mysqli_query($db, "SELECT * FROM pictures WHERE id = {$id_image}");

$row = mysqli_fetch_assoc($result);

$messages = [
    'OK' => 'Сообщение добавлено',
    'DELETE' => 'Сообщение удалено',
    'EDIT' => 'Сообщение изменено',
    'ERROR' => 'Ошибка'
];

$buttonText = 'Добавить';
$action = "create";

if ($_GET['action'] == 'create') {
    $name = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['feedback_text'])));
    $sql = "INSERT INTO feedback(name, feedback_text, data_time, id_images) VALUES ('{$name}', '{$feedback}', NOW(), '{$id_image}')";
    mysqli_query($db, $sql);
    header("Location: /imageViewing.php?message=OK&id_image={$id_image}");
}

$rowWithFeedbackFromDB = null;

if ($_GET['action'] == 'edit') {
    $id_feedback = (int)$_GET['id_feedback'];
    $resultFeedbackForEditFromBD = mysqli_query($db, "SELECT * FROM feedback WHERE id_feedback = '{$id_feedback}'");
    if ($resultFeedbackForEditFromBD) $rowWithFeedbackFromDB = mysqli_fetch_assoc($resultFeedbackForEditFromBD);
    $buttonText = 'Обновить комментарий';
    $action = "save";
}

if ($_GET['action'] == 'save') {
    $name = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['name'])));
    $feedback = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_POST['feedback_text'])));
    $id_feedback = (int)$_POST['id_feedback'];
    $sql = "UPDATE feedback SET name = '{$name}', feedback_text = '{$feedback}', data_time = NOW() WHERE id_feedback = '{$id_feedback}'";
    mysqli_query($db, $sql);
    header("Location: /imageViewing.php?message=EDIT&id_image={$id_image}");
}

if ($_GET['action'] == 'delete') {
    $id_feedback = (int)$_GET['id_feedback'];
    $sql = "DELETE FROM feedback WHERE id_feedback = '{$id_feedback}'";
    mysqli_query($db, $sql);
    header("Location: /imageViewing.php?message=DELETE&id_image={$id_image}");
}

$resultFromFeedBackBD = mysqli_query($db, "SELECT * FROM feedback WHERE id_images = {$id_image} ORDER BY id_feedback DESC");

$message = '';
if (isset($_GET['message'])) {
    $message = $messages[$_GET['message']];
}
if (isset($_GET['addToCart'])) {
    $idProductForCart = strip_tags(htmlspecialchars(mysqli_escape_string($db, $_GET['addToCart'])));
    $sqlCheckExistRow = "SELECT id_cartRecord FROM cart WHERE product_id = '{$idProductForCart}' AND session_id = '{$sessionId}'";
    $resultOfCheckingExistRow = mysqli_query($db, $sqlCheckExistRow);
    if (mysqli_num_rows($resultOfCheckingExistRow) == 0) {
        $sqlInsert = "INSERT INTO cart (`session_id`, `product_id`, `quantity`) VALUES ('{$sessionId}', '{$idProductForCart}', '1')";
        mysqli_query($db, $sqlInsert);
        header("Location: /imageViewing.php?id_image={$id_image}");
    } else {
        $sqlInsert = "UPDATE cart SET quantity = quantity+1 WHERE product_id = '{$idProductForCart}' AND session_id = '{$sessionId}'";
        mysqli_query($db, $sqlInsert);
        header("Location: /imageViewing.php?id_image={$id_image}");
    }
}

$quantityInCart = mysqli_query($db, "SELECT COUNT(*) FROM cart WHERE session_id = '{$sessionId}'");
$quantityInCart = mysqli_fetch_array($quantityInCart);
$quantityInCart = $quantityInCart[0];
include 'repeatFromLesson/index.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Просмотр товара</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<a href="index.php">Вернуться на главную</a><br>
<div>
<img src="<?= IMG . '/' . $row['name'] ?>" alt='somePicture' height="400px"><br>
</div>
<div class="cell" style="width: 30%">
<h3>Название автомобиля: <?= $row['nameOfProduct'] ?></h3>
<h3>Стоимость: <?= $row['costOfProduct'] ?> тыс.руб.</h3>
<h3>Описание: <?= $row['descriptionOfProduct'] ?></h3>
<h3>Количество просмотров: <?= $row['views'] ?></h3>
</div>
<a href="imageViewing.php?addToCart=<?= $id_image ?>&id_image=<?= $id_image ?>"><div class="button">Добавить в корзину</div></a>
<a href="cart.php"><div class="button">Корзина (<?= $quantityInCart ?>)</div> </a> <br>

<br>
<h3>Добавить отзыв:</h3>
<form action="?action=<?= $action ?>&id_image=<?= $id_image ?>" method="post">
    <input type="text" hidden name="id_feedback" value="<?= $rowWithFeedbackFromDB['id_feedback'] ?>">
    <input type="text" placeholder="Ваше имя" name="name" value="<?= $rowWithFeedbackFromDB['name'] ?>">
    <input type="text" placeholder="Ваш отзыв" name="feedback_text"
           value="<?= $rowWithFeedbackFromDB['feedback_text'] ?>">
    <input type="submit" value="<?= $buttonText ?>"><br>
    <?= $message ?>
</form>

<h4>Отзывы счастливых покупателей:</h4>
<h5>
    <? foreach ($resultFromFeedBackBD as $feedback): ?>
        <p>
        <div class="nameFeedbaker"><b><?= $feedback['name'] ?>:</b></div><div class="feedBackText"><?= $feedback['feedback_text'] ?></div>
            <a href="?action=edit&id_feedback=<?= $feedback['id_feedback'] ?>&id_image=<?= $id_image ?>">[Редактировать]</a>
            <a href="?action=delete&id_feedback=<?= $feedback['id_feedback'] ?>&id_image=<?= $id_image ?>">[X]</a><br>
            Добавлено: <?= $feedback['data_time'] ?><br>
        </p>
    <? endforeach; ?>
</h5>

</body>
</html>
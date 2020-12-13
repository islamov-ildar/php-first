<?php

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="index.php">Вернуться на главную</a><br>
<img src="<?= IMG . '/' . $row['name'] ?>" alt='somePicture' height="400px"><br>
<h3>Название автомобиля: <?= $row['nameOfProduct'] ?></h3>
<h3>Стоимость: <?= $row['costOfProduct'] ?> тыс.руб.</h3>
<h3>Описание: <?= $row['descriptionOfProduct'] ?></h3>
<h3>Количество просмотров: <?= $row['views'] ?></h3>

<form action="">
    <input type="submit" value="Купить">
</form>
<br>
<h3>Добавить отзыв:</h3>
<form action="?action=<?=$action?>&id_image=<?=$id_image?>" method="post">
    <input type="text" hidden name="id_feedback" value="<?= $rowWithFeedbackFromDB['id_feedback'] ?>">
    <input type="text" placeholder="Ваше имя" name="name" value="<?= $rowWithFeedbackFromDB['name'] ?>">
    <input type="text" placeholder="Ваш отзыв" name="feedback_text" value="<?=$rowWithFeedbackFromDB['feedback_text']?>">
    <input type="submit" value="<?=$buttonText?>"><br>
    <?= $message ?>
</form>

<h4>Отзывы счастливых покупателей:</h4>
<h5>
    <? foreach ($resultFromFeedBackBD as $feedback): ?>
        <p>
            <b><?= $feedback['name'] ?></b> : <?= $feedback['feedback_text'] ?>
            <a href="?action=edit&id_feedback=<?= $feedback['id_feedback'] ?>&id_image=<?=$id_image?>">[Редактировать]</a>
            <a href="?action=delete&id_feedback=<?= $feedback['id_feedback'] ?>&id_image=<?=$id_image?>">[X]</a><br>
            Добавлено: <?= $feedback['data_time'] ?><br>
        </p>
    <? endforeach; ?>
</h5>

</body>
</html>
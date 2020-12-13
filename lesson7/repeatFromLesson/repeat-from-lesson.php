<?php

include 'db.php';

if ($_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];
    $result = mysqli_query($db, "DELETE FROM news WHERE id = {$id}");
    if (mysqli_affected_rows($db) == 0) {
        header("Location: ?message=1");
    } else {
        header("Location: ?message=OK");
    }
}

$result = mysqli_query($db, "SELECT * FROM news");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>Новости</h2>
<?php while ($row = mysqli_fetch_assoc($result)): ?>
        <p><a href="news.php?id=<?=$row['id']?>"><?= $row['title'] ?></a>
            <a href="?action=delete&id=<?=$row['id']?>">[X]</a>
        </p>
<?php endwhile; ?>
</body>
</html>
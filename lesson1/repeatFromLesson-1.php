<?php
    $a = 'someText';
    echo $a;
    /*$a = 0;
    $a = true;*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php
        echo ' Hello, new Title using PHP!';
        ?></title>
</head>
<body>

<h1><?php echo 'Main Title'?></h1>

    <?php
        echo ' <h2> Hello, world from Mezhevoi twice! </h2>';
        echo ' Hello, world from FruitVillage trice! <br>';
        echo ' Hello, world from FruitVillage four times! <br>';
    echo ' Привет на русском!' . $a . '<br>';
    echo "$a 123" . '<br>';
    echo '$a 123' . '<br>';
    echo "{$a}123" . '<br>'; //экранирование переменной
    echo "<h1 style=\"color: red\">{$a}</h1><br>"; //экранирование тегов при помощи бек-слешей, также можно использовать одинарные кавычки
    $a = 'test2';
    //heredoc - синтаксис который не требует использования кавычек
    echo $a . " changes for GIT";


    echo <<<php
        <h1 style = "color: red">{$a} with Heredoc</h1><br>
        <p>$a</p>   
php;
    $a = 'test3';
    var_dump($a); //вывод переменной которую необходимо посмотреть
    //exit(); //остановка скрипта

    $x = 2;
    $y = (int)'dfdf 2';
    $z = $x + $y;

    echo <<<php
        <h3 style = "color: blue">{$z} with Heredoc</h3><br>  
php;

    ?>

<script>
    var a = <?php echo 12 ?>;
</script>
</body>
</html>
<!--
--><?/*= такая запись тега РНР тоже будет работать "=" тоже что и команда echo
 ' Hello, new Title using PHP!';
*/?>
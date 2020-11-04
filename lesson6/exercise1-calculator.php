<?php

function mathOperation($operation, $a, $b)
{
    switch ($operation) {
        case "+":
            return add($a, $b);
        case "-":
            return difference($a, $b);
        case "*":
            return multiply($a, $b);
        case "/":
            return division($a, $b);
    }
}

function add($a, $b)
{
    return ($a + $b);
}

function difference($a, $b)
{
    return ($a - $b);
}

function multiply($a, $b)
{
    return ($a * $b);
}

function division($a, $b)
{
    if ($b != 0) {
        return ($a / $b);
    } else {
        return "На ноль делить нельзя";
    }
}

if (is_numeric($_POST['operand1']) && is_numeric($_POST['operand2']) ) {
    $result = mathOperation($_POST['operation'], $_POST['operand1'], $_POST['operand2']);
} elseif ($_POST['operand1'] || $_POST['operand2'] == null) {
    $result = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="" method="post">
    <input type="text" value="<?= $_POST['operand1']?>" name="operand1">
    <select name="operation" id="" >
        <option <? if ($_POST['operation'] == '+') echo "selected"?>>+</option>
        <option <? if ($_POST['operation'] == '-') echo "selected"?>>-</option>
        <option <? if ($_POST['operation'] == '/') echo "selected"?>>/</option>
        <option <? if ($_POST['operation'] == '*') echo "selected"?>>*</option>
    </select>
    <input type="text" value="<?= $_POST['operand2']?>" name="operand2">
    <input type="submit" value="=">
    <input type="text" value="<?= $result?>">
</form>
</body>
</html>
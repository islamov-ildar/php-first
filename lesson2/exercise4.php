<?php
function mathOperation($operation, $a, $b)
{
    switch ($operation) {
        case "+":
            echo add($a, $b);
            break;
        case "-":
            echo difference($a, $b);
            break;
        case "*":
            echo multiply($a, $b);
            break;
        case "/":
            echo division($a, $b);
            break;
    }
}

function add ($a, $b){
    return "a + b = " . ($a + $b) . "<br>";
}

function difference ($a, $b){
    return "a - b = " . ($a - $b) . "<br>";
}

function multiply ($a, $b){
    return "a * b = " . ($a * $b) . "<br>";
}

function division ($a, $b){
    if ($b != 0) {
        return "a / b = " . ($a / $b) . "<br>";
    } else {
        return "На ноль делить нельзя";
    }
}

$a = random_int(0, 99);
echo "Число a = " . $a . "<br>";

$b = random_int(0, 99);
echo "Число b = " . $b . "<br>";



mathOperation("/", $a, $b);
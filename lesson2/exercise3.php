<?php
$a = random_int(0, 99);
echo "Число a = " . $a . "<br>";

$b = random_int(0, 99);
echo "Число b = " . $b . "<br>";

function add ($a, $b){
    return "a + b = " . ($a + $b) . "<br>";
}

echo add($a, $b);

function difference ($a, $b){
    return "a - b = " . ($a - $b) . "<br>";
}

echo difference($a, $b);

function multiply ($a, $b){
    return "a * b = " . ($a * $b) . "<br>";
}

echo multiply($a, $b);

function division ($a, $b){
    if ($b != 0) {
        return "a / b = " . ($a / $b) . "<br>";
    } else {
        return "На ноль делить нельзя";
    }
}

echo division($a, $b);
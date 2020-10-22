<?php
$a = random_int(-99, 99);
$b = random_int(-99, 99);

if ($a >= 0 && $b >= 0){
    echo "Оба числа положительные <br>";
    echo $a - $b;
} else if ($a < 0 && $b < 0){
    echo "Оба числа отрицательные <br>";
    echo $a * $b;
} else {
    echo "Числа разных знаков <br>";
    echo $a + $b;
}
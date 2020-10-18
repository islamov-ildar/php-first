<?php
$a = random_int(0, 15);
echo "Стартовое число " . $a . "<br>";

function render($a){
    $a++;
    echo $a . ";";
    if ($a <15){
        render($a);
    }
}

render($a);
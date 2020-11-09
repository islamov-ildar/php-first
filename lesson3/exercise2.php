<?php
function outputNumberEvenUneven($maxRange) {
    $i = 0;
    $result = null;
    do {
        if ($i == 0) {
            $result .= "$i - это ноль<br>";
        };
        ++$i;
        if ($i % 2 !== 0) {
            $result .= "$i - нечетное число<br>";
        } else {
            $result .= "$i - четное число<br>";
        }
    } while ($i < $maxRange);
    return $result;
}

echo outputNumberEvenUneven(100);
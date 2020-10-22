<?php

function outputNumberWithoutRemainder_3 ($limit) {
    $result = null;
    $i = 0;
    while ($i <= $limit) {
        if ($i % 3 === 0) {
            $result .= $i;
        }
        $i++;
    }
    return $result;
};

echo outputNumberWithoutRemainder_3(100);

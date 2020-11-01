<?php
$phrase = "По реке плывет топор";

function replace($phrase) {
    return str_replace(" ", "_", $phrase);
}

echo replace($phrase);


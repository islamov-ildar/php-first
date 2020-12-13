<?php

/*
<ul>
	<li><a href='#'>Меню1</a></li>
	<li><a href='#'>Меню2</a></li>
	<li><a href='#'>Меню3</a></li>
	<li><a href='3'>Меню4</a></li>
</ul>
*/

$menu = [
    "Меню 1" => "#",
    "Меню 2" => "#",
    "Меню 3" => "#",
    "Меню 4" => "#",
    "Меню 5" => [
        "Меню 5.1" => "#",
        "Меню 5.2" => "#",
        "Меню 5.3" => "#",],
];

function getArr($arr) {
    $result = "<ul>";
    foreach ($arr as $key => $value) {
        if(is_array($value)) {
            $result .= "<li><a href='#'>$key</a><ul>";
            foreach ($value as $itemKey => $item) {
                $result .= "<li><a href='$item'>$itemKey</a></li>";
            };
            $result .= "</ul></li>";
        } else {
            $result .= "<li><a href='$value'>$key</a></li>";
        }
    }
    return $result . "</ul>";
};

echo getArr($menu);


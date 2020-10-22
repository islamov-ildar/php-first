<?php

$alphabet = [
    'а' => 'a', 'б' => 'b', 'в' => 'v',
    'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
    'и' => 'i', 'й' => 'y', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n',
    'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 's', 'т' => 't', 'у' => 'u',
    'ф' => 'f', 'х' => 'h', 'ц' => 'c',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
    'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
];

$word = "По реке плывет топор";

function translator($word, $alphabet)
{
    $output = null;
    $word = mb_str_split($word);
    for ($i = 0; $i < count($word); $i++) {
        $lowerLetter = mb_strtolower($word[$i]);
        if (array_key_exists($lowerLetter, $alphabet)) {
            if ($word[$i] != $lowerLetter) {
                $output .= mb_strtoupper($alphabet[$lowerLetter]);
            } else {
                $output .= $alphabet[$lowerLetter];
            }
        } else {
            $output .= $lowerLetter;
        }
    }
    return str_replace(" ", "_", $output);
}

echo translator($word, $alphabet);

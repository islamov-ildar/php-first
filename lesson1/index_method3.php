<!--Exercise-4-3-->
<?php
    $h1 = "Информация обо мне (Третий способ)";
    $title = "Главная страница - страница обо мне";
    $year = 2018;

    $content = file_get_contents("template_for_method3.html");

    $content = str_replace("{{ h1 }}", $h1, $content);
    $content = str_replace("{{ title }}", $title, $content);
    $content = str_replace("{{ year }}", $year, $content);

    echo $content;
?>

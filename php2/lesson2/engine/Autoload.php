<?php

namespace app\engine;

class Autoload
{
    private $path = [
        'models',
        'engine',
        'interfaces'
    ];

    public function loadClass($className)
    {
        $className = str_replace("app", "..", $className);
        $className = str_replace("\\", "/", $className);
        //var_dump($className);
        //приходит app\models\Product
        //а надо ../models/Product.php
        // использовать str_replace
        foreach ($this->path as $path) {

            $fileName = "../{$path}/{$className}.php";
            //var_dump($className);

            if (file_exists($fileName)) {
                include $fileName;
                break;
            }
        }
    }

}
<?php

use app\models\{Product, User, Cart, Order}; // - создание псевдонима для того чтобы уйти от длинного написания имени класса с пространством имен - останется только
// Product, имена классов из одинакового пространства имен можно перечислить через запятую в фигурных скобках

use app\engine\{Autoload};

include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']); //еще более быстрый способ создания экземпляра класса и вызова метода

$product = new Product();

//var_dump($product->getOne(1));

$product = new Product("Кукуруза", "Астраханская", 13);
$product->insert(); //TODO реализовать метод вставки в БД - Done!
var_dump($product);

$user = new User("user", "321");
$user->insert();
$user2 = new User("user2", "2321");
$user2->insert();

var_dump($user, $user2);

$user2->delete();

var_dump($user->getAll());


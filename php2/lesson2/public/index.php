<?php

use app\models\{Product, User, Cart, Order}; // - создание псевдонима для того чтобы уйти от длинного написания имени класса с пространством имен - останется только
// Product, имена классов из одинакового пространства имен можно перечислить через запятую в фигурных скобках

use app\engine\{Db,Autoload};
use app\interfaces\IModel;

include "../engine/Autoload.php";

//автозагрузка классов в РНР:
spl_autoload_register([new Autoload(), 'loadClass']); //еще более быстрый способ создания экземпляра класса и вызова метода

/*
spl_autoload_register('loader');

function loader($className) {
    $load = new Autoload();
    $load->loadClass($className);

    //(new Autoload())->loadClass($className); - альтернативный синтаксис создания экземпляра и вызова метода
}
*/

$product = new Product(new Db()); //создание экземпляра класса с использованием псевдонима
var_dump($product->getOne(5));

$user = new User(new Db());
var_dump($user->getAll());
//$db = new Db(); // - создание экземпляра класса с учетом виртуальной папки пространства имен

//var_dump($product);
//var_dump($user);
//var_dump($db);

function foo(IModel $model) {
    $model->insert();
}

$cart = new Cart(new Db());
var_dump($cart->insert());

$order = new Order(new Db());
var_dump($order->delete());
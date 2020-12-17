<?php

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A {

}

$a1 = new A;
$b1 = new B;
$a1->foo(); //1 преинкремент к х=0 экземпляра класса А
$b1->foo(); //1 преинкремент к х=0 экземпляра класса В
$a1->foo(); //2 преинкремент к х=1 экземпляра класса А
$b1->foo(); //2 преинкремент к х=1 экземпляра класса В
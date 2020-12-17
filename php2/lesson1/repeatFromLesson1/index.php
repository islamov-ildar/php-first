<?php
class Human {
    protected string $name; //public - идентификатор доступа к полю (в JS-свойство) класса, также как в JS можно создавать поля динамически при обращению к экземпляру класса, они будут public
    protected int $health;
    const PI = 3.14; //константа будет принадлежать классу а не экземпляру!
    public static int $count = 0; //статическая переменная также принадлежит классу, но её можно менять. Будет равна только себе во всех экземплярах класса

    function __construct($name = null, $health = null) { //метод конструктора для создания экземпляра класса
        //var_dump('Вызов родительского конструктора');
        $this->name = $name;
        $this->health = $health;
        //echo "Вызван конструктор </br>";
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
    }

    public function setHealth(?int $health)
    {
        $this->health = $health;
    }



    function say() { //Метод класса

        //echo self::PI . "</br>"; //через self можно обратиться к константе или статической переменной класса.

        echo "Меня зовут {$this->name} и у меня {$this -> health} жизней </br>";

        //echo "Счетчик = " . self::$count;

    }
}

$human1 = new Human('Stephan', 200);
$human1->say();

$human2 = new Human('Nicolas', 20);
$human2->say();

$human3 = clone $human1; //можно создавать экземпляры класса клонируя другие экземпляры
//$human3->name = "Peter"; - задание поля напрямую в экземпляр объекта (работает только если поле public)
$human3->setName("Peter"); // задание поля через сеттер
//$human3->health = 400; - задание поля напрямую в экземпляр объекта (работает только если поле public)
$human3->setHealth(400); // задание поля через сеттер
$human3->say();


class Warrior extends Human {
    public int $damage;

    public function __construct($name = null, $health = null, $damage = null)
    {
        //var_dump('Вызов дочернего конструктора');
        parent::__construct($name, $health); //наследование конструктора от родительского класса
        $this->damage = $damage;
    }

    public function attack(Human $unit) { //Human - тип данных "объект класса Human",  $unit - временная переменная в которую этот объект положили
        $unit->health -= $this->damage;
        echo "{$this->name} нанес урон {$unit->name}</br>";
    }

    public function say()
    {
        parent::say();
        echo "и я могу атаковать с силой {$this->damage} </br>";
    }

}

$warrior = new Warrior("Akhiless", 500, 15);

$warrior->say();
//var_dump($warrior);

$warrior->attack($human1);
$warrior->attack($human2);
$warrior->attack($human3);

var_dump($human3);

class Boss extends Warrior {
    public int $mana;

    public function superAttack () {

    }
}

/*
 * public позволяет обращаться к свойствам и методам отовсюду;
● private позволяет обращаться к свойствам и методам только
внутри текущего класса;
● protected позволяет обращаться к свойствам и методам только из
текущего класса и классов наследников.
 * */

/*
$human1::$count++;
$human1 -> name = 'Alex';
$human1 -> health = 95;
$human1 -> say();
var_dump($human1);

$human2 = new Human();
$human2::$count++;
$human2 -> name = 'Valery';
$human2 -> health = 105;
$human2 -> say();

var_dump($human2);

echo Human::PI; // к константам можно обратиться не создавая экземпляров классов
//var_dump(get_class_methods($human));
*/

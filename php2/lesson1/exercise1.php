<?php

class Human {
    protected string $name;
    protected int $age;
    protected string $education; //выбор из массива "высшее", "среднее"
    static array $educationType = ['special', 'high'];
    protected string $location;

    public function changeLocation($newLocation){
        $this->$this->location = $newLocation;
    }

    public function __construct($name = null, $age = null, $education = null, $location = null)
    {
        $this->name = $name;
        $this->education = static::$educationType[$education];
        $this->age = $age;
        $this->location = $location;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    public function setEducation(?int $education): void
    {
        $this->education = static::$educationType[$education];
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}

$human = new Human('Ivan', 25, 0,'Nizhnevartovsk');

var_dump($human);

class OilFieldWorker extends Human {
    protected $workExpirienceYear; //опыт работы в целых годах

    static array $equipmentList = ['Telemetrix', 'APS', 'Tensor'];

    static int $drillingInterval = 600;

    protected string $canWorkedOnEquipment;

    public function getWorkExpirienceYear(): ?int
    {
        return $this->workExpirienceYear;
    }

    public function setWorkExpirienceYear(?int $workExpirienceYear): void
    {
        $this->workExpirienceYear = $workExpirienceYear;
    }

    public function __construct($name = null, $age = null, $education = null, $location = null, $workExpirienceYear = null, $canWorkedOnEquipment = null)
    {
        parent::__construct($name, $age, $education, $location);
        $this->workExpirienceYear = $workExpirienceYear;
        $this->canWorkedOnEquipment = static::$equipmentList[$canWorkedOnEquipment];
    }

    public function workOnWell(Well $well) {
        echo "{$this->name} работает на скважине {$well->nameOfWell}";
        $well->currentDepth += static::$drillingInterval;
    }
}
$mwdEngeneer = new OilFieldWorker('Dmitry', 30, 1, 'Kogalym', 10, 0);

var_dump($mwdEngeneer);

class Well {
    public string $nameOfWell;
    public float $currentDepth;

    public function __construct($nameOfWell, $currentDepth)
    {
        $this->nameOfWell = $nameOfWell;
        $this->currentDepth = $currentDepth;
    }
}

$well1 = new Well('6c', 2000);

$mwdEngeneer->workOnWell($well1);

var_dump($well1);
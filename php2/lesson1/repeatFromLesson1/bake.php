<?php

class Bake {

}

class ElectircBake extends Bake {
    public function work() {
        echo "Печет электричеством</br>";
    }
}

class GasBake extends Bake {
    public function work() {
        echo "Печет газом</br>";
    }
}
class InductionBake extends Bake {
    public function work() {
        echo "Печет индукцией</br>";
    }
}

class Baker {
    public function bake (Bake $bake) {
        $bake->work();
    }
}

$gas = new GasBake();

$ele = new ElectircBake();

$worker = new Baker();

$induct = new InductionBake();

$worker->bake($gas);
$worker->bake($ele);
$worker->bake($induct);
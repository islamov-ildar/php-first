<?php
$cars = [
['name' => 'Такси 1', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
['name' => 'Такси 2', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
['name' => 'Такси 3', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
['name' => 'Такси 4', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
['name' => 'Такси 5', 'position' => rand(0, 1000), 'isFree' => (bool) rand(0, 1)],
];

$passenger = rand(0, 1000);

/* ===== Ваш код ниже ===== */

$positionOfTaxi = [];
foreach ($cars as $key => $infoAboutTaxi) {
    if ($infoAboutTaxi['isFree'] == true){
        array_push($positionOfTaxi, $infoAboutTaxi['position']);
    }
}
$minPositionOfTaxi = min($positionOfTaxi);

$result = null;
foreach ($cars as $key => $infoAboutTaxi) {
    $distantionOfPassenger = abs($infoAboutTaxi['position'] - $passenger);

    $result .= '"' . $infoAboutTaxi['name'] . " , стоит на " . $infoAboutTaxi['position'] . " км " . " до пассажира " . $distantionOfPassenger;

    if ($infoAboutTaxi['isFree'] == true && $infoAboutTaxi['position'] == $minPositionOfTaxi) {
        $result .= "(свободен) - едет это такси" . '"' . "<br>";

    } elseif($infoAboutTaxi['isFree'] == true) {
        $result .= "(свободен)" . '"' . "<br>";

    } else {
        $result .= "(занят)" . '"' . "<br>";

    }

}
echo $result;


/*
"Такси 1, стоит на 15 км, до пассажира 3 км (занят)"
"Такси 2, стоит на 0 км, до пассажира 12 км (свободен) - едет это такси"
"Такси 3, стоит на 300 км, до пассажира 288 км (свободен)"*/

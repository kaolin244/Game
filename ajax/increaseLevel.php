<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$place = $_POST["place"];
$village_id = $_POST["village_id"];

$data_json = file_get_contents("../JSON/buildings.json");
$info = json_decode($data_json);
$max_lvl = $info->$place->max_level;

$data_mySql_lvl = $ajax_class->getLevel($village_id);

$data_mySql = $ajax_class->amountBelt($village_id);

$date = new DateTime;
$date_now = $date->format('Y-m-d H:i:s');
$date_str = strtotime($date_now);
$date_last = strtotime($data_mySql->last_check);

$difference = $date_str - $date_last;
$level = $data_mySql_lvl->$place;
$Drwal_lvl = $data_mySql_lvl->Drwal;
$Kopalnia_lvl = $data_mySql_lvl->Kopalnia;
$Farma_lvl = $data_mySql_lvl->Farma;
$Dom_lvl = $data_mySql_lvl->Dom;
$Magazyn_lvl = $data_mySql_lvl->Magazyn;


$wood = $data_mySql->wood + $info->Drwal->production->$Drwal_lvl * $difference;
$stone = $data_mySql->stone + $info->Kopalnia->production->$Kopalnia_lvl * $difference;
$food = $data_mySql->food + $info->Farma->production->$Farma_lvl * $difference;

$population = $data_mySql->population;
$population_new = $population;

$storage = $info->Magazyn->storage->$Magazyn_lvl;

if($wood > $storage)
    $wood = $storage;
if($stone > $storage)
    $stone = $storage;
if($food > $storage)
    $food = $storage;

$error = "nope";
if($place == "Drwal")
    $Drwal_lvl++;
else if($place == "Kopalnia")
    $Kopalnia_lvl++;
else if($place == "Farma")
    $Farma_lvl++;
else if($place == 'Magazyn')
    $Magazyn_lvl++;

$wood_p = $info->Drwal->production->$Drwal_lvl;
$stone_p = $info->Kopalnia->production->$Kopalnia_lvl;
$food_p = $info->Farma->production->$Farma_lvl;
$storage = $info->Magazyn->storage->$Magazyn_lvl;

$jsonData = '{';
if($level < $max_lvl)
{
    $level++;
    if($place != "Dom")
    {
        $wood_new = $wood - $info->$place->cost_wood->$level;
        $stone_new = $stone - $info->$place->cost_stone->$level;
        $food_new = $food - $info->$place->cost_food->$level;
        $population_new = $population - $info->$place->cost_population->$level;
    }
    else
    {
        $wood_new = $wood - $level * $level;
        $stone_new = $stone - $level * $level;
        $food_new = $food - $level * $level;
        $population_new = $population + $level * $level;
    }

    if($wood_new < 0 || $stone_new < 0 || $food_new < 0 || $population_new < 0)
    {
        $wood_new = $wood;
        $stone_new = $stone;
        $food_new = $food;
        $population_new = $population;
        $error = "lamus";
        $level--;
    }

    $ajax_class->updateAmount($wood_new, $stone_new, $food_new, $population_new, $date_now, $village_id);
    $jsonData .= '"wood": '.$wood_new;
    $jsonData .= ', "stone": '.$stone_new;
    $jsonData .= ', "food": '.$food_new;
    $jsonData .= ', "population": '.$population_new;


}

else
{
    $level = $max_lvl;
    $jsonData .= '"wood": '.$wood;
    $jsonData .= ', "stone": '.$stone;
    $jsonData .= ', "food": '.$food;
    $jsonData .= ', "population": '.$population;
}


$ajax_class->increaseLevel($place, $level, $village_id);

$jsonData .= ', "wood_p": '.$wood_p;
$jsonData .= ', "stone_p": '.$stone_p;
$jsonData .= ', "food_p": '.$food_p;
$jsonData .= ', "storage": '.$storage;
$jsonData .= ', "NewLevel": '.$level;
$jsonData .= ', "errors": "'.$error.'"';

$jsonData .= '}';

echo $jsonData;
<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$data_php3= $ajax_class->getVillageId($session_uid);
$village_id = $data_php3->village_id;
$data_php = $ajax_class->amountBelt($village_id);
$data_json = file_get_contents("../JSON/buildings.json");
$info = json_decode($data_json);
$last_time = strtotime($data_php->last_check);

$date = new DateTime;
$date_now = $date->format('Y-m-d H:i:s');


$now_time = strtotime($date_now);
$difference = ($now_time - $last_time);


$data_php2 = $ajax_class->displayBuildings($village_id);

$Drwal_lvl = $data_php2->Drwal;
$wood = $data_php->wood + $info->Drwal->production->$Drwal_lvl*$difference;

$Kopalnia_lvl = $data_php2->Kopalnia;
$stone = $data_php->stone + $info->Kopalnia->production->$Kopalnia_lvl*$difference;

$Farma_lvl = $data_php2->Farma;
$food = $data_php->food + $info->Farma->production->$Farma_lvl*$difference;
$population = $data_php->population;

$Magazyn_lvl = $data_php2->Magazyn;

$food_p = $info->Farma->production->$Farma_lvl;
$wood_p = $info->Drwal->production->$Drwal_lvl;
$stone_p = $info->Kopalnia->production->$Kopalnia_lvl;
$storage = $info->Magazyn->storage->$Magazyn_lvl;

if($wood >= $storage)
{
    $wood = $storage;
    $wood_p = 0;
}
if($stone >= $storage)
{
    $stone = $storage;
    $stone_p = 0;
}
if($food >= $storage)
{
    $food = $storage;
    $food_p = 0;
}
$ajax_class->updateAmount($wood, $stone, $food, $population, $date_now, $village_id);

$jsonData = '{';
$jsonData .= '"wood": '.$wood;
$jsonData .= ', "stone": '.$stone;
$jsonData .= ', "food": '.$food;
$jsonData .= ', "food_p": '.$food_p;
$jsonData .= ', "wood_p": '.$wood_p;
$jsonData .= ', "stone_p": '.$stone_p;
$jsonData .= ', "population": '.$population;
$jsonData .= ', "storage": '.$storage;
$jsonData .= '}';

echo $jsonData;
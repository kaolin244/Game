<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$Miecznik_Amount = $_POST["Miecznik"];
$Lucznik_Amount = $_POST["Lucznik"];
$village_id = $_POST["village_id"];

$data_json = file_get_contents("../JSON/army.json");
$info = json_decode($data_json);

$data_mySql = $ajax_class->amountBelt($village_id);

$error = 'nope';
$wood = $data_mySql->wood;
$stone = $data_mySql->stone;
$food = $data_mySql->food;
$population = $data_mySql->population;
$date = $data_mySql->last_check;

$wood_new = $wood - (($Miecznik_Amount * $info->Miecznik->cost_wood) + $Lucznik_Amount * $info->Lucznik->cost_wood);
$stone_new = $stone - (($Miecznik_Amount * $info->Miecznik->cost_stone) + $Lucznik_Amount * $info->Lucznik->cost_stone);
$food_new = $food - (($Miecznik_Amount * $info->Miecznik->cost_food) + $Lucznik_Amount * $info->Lucznik->cost_food);
$population_new = $population - ($Miecznik_Amount + $Lucznik_Amount);
if($wood_new < 0 || $stone_new < 0 || $food_new < 0 || $population_new < 0)
    $error = 'lamus';

if($error == 'nope')
{
    $ajax_class->updateAmount($wood_new, $stone_new, $food_new, $population_new, $date, $village_id);
    $data_mySql_lvl = $ajax_class->displayBarrack($village_id);
    $Miecznik_Amount_new = $data_mySql_lvl->Miecznik + $Miecznik_Amount;
    $Lucznik_Amount_new = $data_mySql_lvl->Lucznik + $Lucznik_Amount;
    $ajax_class->updateArmy($Miecznik_Amount_new, $Lucznik_Amount_new, $village_id);
}


$jsonData = '{';
$jsonData .= ' "errors": "'.$error;
$jsonData .= '"}';

echo $jsonData;
<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$data_mySql_user = $ajax_class->getVillageId($session_uid);
$village_id = $data_mySql_user->village_id;
$data_mySql_army = $ajax_class->displayBarrack($village_id);
$data_mySql_village = $ajax_class->villageOwner($session_uid);
$owner_position = $data_mySql_village->map_position;
$condition = $_POST['condition'];

$owner_x = $owner_position % 10;
$owner_y = floor($owner_position / 10);
$enemy_x = $enemy_position % 10;
$enemy_y = floor($enemy_position / 10);


$diff_x = abs($owner_x - $enemy_x);
$diff_y = abs($owner_y - $enemy_y);
$distance = round(hypot($diff_x, $diff_y), 2);

$time = date('H:i:s',($distance * 60) - 3600);

$jsonData = '{';

$jsonData .= '"Time": "'.$time;
$jsonData .= '"}';

echo $jsonData;
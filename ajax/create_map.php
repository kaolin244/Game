<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$data_php = $ajax_class->mapDrawing();
$owner = $ajax_class->villageOwner($session_uid);
$jsonData = '{';
$i = 0;

$jsonData .= '"owner":{"map_position":'.$owner->map_position.'}, ';
foreach ($data_php as $row)
{
    $i++;
    $jsonData .= '"'.$i.'":{ "map_position": ';
    $jsonData .= $row->map_position.'},';
}

$jsonData = chop($jsonData, ",");
$jsonData .= '}';

echo $jsonData;
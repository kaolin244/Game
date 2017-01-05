<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$index = $_POST["index"];

$data_php = $ajax_class->showInfo($index);

$jsonData = '{';

$jsonData .= '"village":{"village_name": "'.$data_php->village_name.'","points": '.$data_php->points.',';
if($data_php->user_id == $session_uid)
    $jsonData .= ' "owner": 1}';
else
    $jsonData .= ' "owner": 0}';

$jsonData .= '}';

echo $jsonData;
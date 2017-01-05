<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');

$data_php = $ajax_class->generalInfoUser($session_uid);
$data_php2 = $ajax_class->generalInfoMap($session_uid);

$jsonData = '{';

$jsonData .= '"user_name": "'.$data_php->username;
$jsonData .= '", "points": '.$data_php2->points;
$jsonData .= ',"village_name": "'.$data_php2->village_name.'"';

$jsonData .= '}';

echo $jsonData;
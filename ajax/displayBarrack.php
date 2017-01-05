<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');


$data_mySql_vid= $ajax_class->getVillageId($session_uid);
$village_id = $data_mySql_vid->village_id;

$data_mySql = $ajax_class->displayBarrack($village_id);

$jsonData = '{';

$jsonData .= '"Miecznik": '.$data_mySql->Miecznik;
$jsonData .= ', "Lucznik": '.$data_mySql->Lucznik;
$jsonData .= ', "village_id": '.$village_id;
$jsonData .= '}';

echo $jsonData;
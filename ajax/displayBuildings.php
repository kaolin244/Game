<?php
header("Content-Type: application/json");
include('../config.php');
include('../session.php');


$village_id = $ajax_class->getVillageId($session_uid);
$id = $village_id->village_id;
$data_php = $ajax_class->displayBuildings($id);

$jsonData = '{';

$jsonData .= '"Magazyn": '.$data_php->Magazyn;
$jsonData .= ', "Farma": '.$data_php->Farma;
$jsonData .= ', "Kopalnia": '.$data_php->Kopalnia;
$jsonData .= ', "Drwal": '.$data_php->Drwal;
$jsonData .= ', "Dom": '.$data_php->Dom;
$jsonData .= ', "village_id": '.$id;


$jsonData .= '}';

echo $jsonData;
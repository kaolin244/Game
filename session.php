<?php
if(!empty($_SESSION['uid']))
{
    $session_uid = $_SESSION['uid'];
    $enemy_position = $_SESSION['enemy_s'];
    include('class/allClass.php');
    include('class/ajax_class.php');
    $userClass = new userClass();
    $ajax_class = new ajax_class();
}
if(empty($session_uid))
{
    $url = BASE_URL.'index.php';
    header("Location: $url");
}
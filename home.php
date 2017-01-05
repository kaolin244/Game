<?php
include('config.php');
include('session.php');

$userDetails = $userClass -> userDetails($session_uid);
$village_id = $userClass->firstLogin($session_uid);
?>
<html>
    <head>
        <title>Mapa</title>
        <link rel="stylesheet" href="css/game.css">
    </head>
    <body>
        <h1>Hi <?php echo $userDetails->username; ?></h1>
        <div class="containerClass" id="container">
            <div class="mapClass" id="map"></div>
            <div class="infoOwnerClass" id="infoPanel">
                <p id="nickInfo"></p>
                <p id="villageName"></p>
                <p id="points"></p>
                <ul id="myVillageButton">
                </ul>
            </div>
        </div>

        <p><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></p>
        <script src="ajax/ajax_script.js"></script>
    </body>
</html>

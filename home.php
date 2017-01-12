<?php
include('config.php');
include('session.php');

$userDetails = $userClass -> userDetails($session_uid);
$village_id = $userClass->firstLogin($session_uid);
?>
<html>
    <head>
        <title>Mapa</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <iframe src = 'map.php' frameBorder="0" class = 'loading_content_class' name = 'loading_content'>

        </iframe>

        <div class = 'menu_class'>
            <ul>
                <li><a href = 'village.php' target = 'loading_content'>Wioska</a></li>
                <li><a href = 'map.php' target = 'loading_content'>Mapa</a></li>
                <li>Wiadomości</li>
                <li>Raporty</li>
                <li><a href="<?php echo BASE_URL; ?>logout.php">Wyloguj</a></li>
                <li>?Armia?</li>
            </ul>
        </div>
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

        <script src="ajax/main.js"></script>
    </body>
</html>

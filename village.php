<?php
include('config.php');
include('session.php');
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>A</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/village.css">
</head>
<body>
    <div id="warapper" class="wrapperClass">

        <div id = "belt" class = "beltClass">

        </div>
       <!-- <div id = "conteiner" class = "conteinerClass">-->
            <div id = "infoBelt" class = "infoBeltClass">

            </div>
            <div id = "buildings" class = "buildingsClass hide">

            </div>
            <div id = "army" class = "armyClass show">

            </div>
            <div id = "menu" class = "menuClass" >
                <ul>
                    <li><button id = "buildingButton">Budynki</button></li>
                    <li><button id = "armyButton">Koszary</button></li>
                    <li>Armia</li>
                    <li><a href = "home.php"><button>Mapa</button></a></li>
                </ul>
            </div>
       <!-- </div>-->
    </div>
    <script src = "ajax/ajax_village.js">

    </script>
</body>
</html>
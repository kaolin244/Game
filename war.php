<?php
include('config.php');
include('session.php');

$userDetails = $userClass -> userDetails($session_uid);
$userClass->firstLogin($session_uid);
$army_data = $ajax_class->displayBarrack($session_uid);
$enemy = $_GET['enemy'];

$_SESSION['enemy_s'] = $enemy;
$data_php = $ajax_class->showInfo($enemy);
?>
<html>
<head>
    <title>Wojna</title>
    <link rel="stylesheet" href="css/game.css">
</head>
<body>
    <?php echo $data_php->village_name?>
    <div class = war_army>
        <ul>
            <li>Miecznik: <input id = 'swordsman_input' type = 'number' min = 0 value = '0'><button id = 'swordsman_btn'></button></li>
            <li>Lucznik: <input id = 'archer_input' type='number' min = 0 value = '0'><button id = 'archer_btn'></button></li>
        </ul>
        <div>
            Czas trwania:
            <span id = 'time_span'></span>
        </div>
        <div>
            Czas dotarcia:
            <span id = 'end_time'>00:00:00</span>
        </div>
        <div>
            Wyśli wojska w celu:
            <button id = 'attack_btn'>Atak</button>
            <button id = 'help_btn'>Pomoc(IA)</button>
        </div>
    </div>
    <a href = "home.php"><button>Mapa</button></a>
    <p><a href="<?php echo BASE_URL; ?>logout.php">Logout</a></p>
    <script src="script/war_script.js"></script>
</body>
</html>

<?php
include("config.php");
include("class/allClass.php");
$userClass = new userClass();


$errorMsgLogin='';
$signupMsg='';



if(!empty($_POST['loginSubmit']))
{
    $user = $_POST['userEmailLog'];
    $password = $_POST['passwordLog'];
    if(strlen(trim($user)) > 1 && strlen(trim($password)) > 1)
    {
        $uid = $userClass -> userLogin($user, $password);
        if($uid)
        {
            $url = BASE_URL.'home.php';
            header("Location: $url");
        }else
        {
            $errorMsgLogin="Sprawdź nazwę gracza lub hasło";
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Game o game</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <div class = "loginRegForm" id="loginFormID">
            <h3>Logowanie</h3>
            <form method="post" action="" name="loginForm">
                <input type="text" name="userEmailLog" placeholder="Login" autocomplete="off">
                <input type="password" name="passwordLog" placeholder="Hasło" autocomplete="off">
                <div class = "formMsg">
                    <?php echo  $errorMsgLogin?>
                </div>
                <input type="submit" name="loginSubmit" class="loginRegSubmit" value="Logowanie">
            </form>

        <div class = "switchForm" >
           Nie masz konata?<a href="signup.php"> Zarejestruj się</a>
        </div>
            <div>
                <object type="text/html" data="http://localhost:3000/?id=1" width="800px" height="600px" style="overflow:auto;border:5px ridge blue">
                </object>
            </div>

    <?php echo $signupMsg; ?>

</body>
</html>



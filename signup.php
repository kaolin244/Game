<?php
include("config.php");
include("class/allClass.php");
$userClass = new userClass();

$errorMsgReg='';

if(!empty($_POST['signupSubmit']))
{
    $username = $_POST['usernameReg'];
    $email = $_POST['emailReg'];
    $password = $_POST['passwordReg'];

    $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
    $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
    $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

    if($username_check && $email_check && $password_check  > 0)
    {

        $uid = $userClass -> userRegistration($username, $password, $email);
        if($uid)
        {

            $errorMsgReg = "Konto zostało założone";
        }else
        {
            $errorMsgReg = "Nazwa gracza lub e-mail już zostały użyte.";
        }
    }else
    {
        $errorMsgReg = "Wprowadz poprawne dane";
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

        <div class = "loginRegForm" id="signupFormID">
            <h3>Rejestracja</h3>
            <form method="post" action="" name="signup">
                <input type="text" name="usernameReg" placeholder="Login" autocomplete="off" />
                <input type="text" name="emailReg" placeholder="E-mail" autocomplete="off" />
                <input type="password" name="passwordReg" placeholder="Hasło" autocomplete="off"/>
                <div class = "formMsg">
                    <?php echo $errorMsgReg?>
                </div>
                <input type="submit" class="loginRegSubmit" name="signupSubmit" value="Rejestracja">
            </form>
            <div class = "switchForm" >
                Masz już konto?<a href="index.php"> Zaloguj się</a>
            </div>
        </div>
    </body>
</html>
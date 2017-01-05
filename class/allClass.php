<?php

class userClass
{
    public function userLogin($usernameEmail, $password)
    {
        try {
            $db = getDB();
            $hash_password = hash('sha256', $password);
            $stmt = $db->prepare("SELECT uid FROM users WHERE (username=:usernameEmail or email=:usernameEmail) AND password=:hash_password");
            $stmt -> bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
            $stmt -> bindParam("hash_password", $hash_password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $data = $stmt -> fetch(PDO::FETCH_OBJ);
            $db = null;

            if($count) {
                $_SESSION['uid'] = $data->uid;
                $_SESSION['enemy_s'] = 0;
                return true;
            } else{
                return false;
            }
        }
        catch(PDOException $e){
            echo '{"error":{"text":'. $e -> getMessage() .'}}';
        }
    }

    public function userRegistration($username, $password, $email)
    {
        try
        {
            $db = getDB();
            $st=$db->prepare('SELECT uid FROM users WHERE username=:username OR email=:email');
            $st->bindParam("username", $username, PDO::PARAM_STR);
            $st->bindParam("email", $email, PDO::PARAM_STR);
            $st->execute();
            $count=$st->rowCount();
            echo $count;
            if($count<1)
            {
                $stmt=$db->prepare("INSERT INTO users(username, password, email) VALUES (:username, :hash_password, :email)");
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $hash_password = hash('sha256', $password);
                $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
                $stmt->bindParam("email", $email, PDO::PARAM_STR);
                $stmt->execute();
                $uid=$db->lastInsertId();
                $db=null;
                $_SESSION['uid']=$uid;
                return true;
            }
            else
            {
                $db=null;
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    public function firstLogin($uid)
    {
        try
        {
            $db = getDB();
            $st = $db->prepare("SELECT village_id FROM map WHERE user_id=:uid");
            $st->bindParam("uid", $uid, PDO::PARAM_INT);
            $st->execute();
            $count = $st->rowCount();
            $st = null;
            if($count < 1)
            {
                $nst = $db->prepare("SELECT username FROM users WHERE uid=:uid");
                $nst->bindParam("uid", $uid, PDO::PARAM_INT);
                $nst->execute();
                $data = $nst->fetch(PDO::FETCH_OBJ);

                $village_name = "wioska_".$data->username;
                $map_position = rand(0,99);
                $stmt = $db->prepare("INSERT INTO map(user_id, map_position, points, village_name) VALUES (:uid, :map_position, 0, :village_name)");
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("map_position", $map_position, PDO::PARAM_INT);
                $stmt->bindParam("village_name", $village_name, PDO::PARAM_INT);
                $stmt->execute();

                $st = $db->prepare("SELECT village_id FROM map WHERE user_id=:uid");
                $st->bindParam("uid", $uid, PDO::PARAM_INT);
                $st->execute();
                $data = $st->fetch(PDO::FETCH_OBJ);

                $village_id = $data->village_id;

                $stmt = null;
                $stmt = $db->prepare("INSERT INTO buildings(village_id) VALUES (:village_id)");
                $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
                $stmt->execute();

                $date = new DateTime;
                $date_now = $date->format('Y-m-d H:i:s');
                $stmt = null;
                $stmt = $db->prepare("INSERT INTO amount(village_id, last_check) VALUES (:village_id, :date_now)");
                $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
                $stmt->bindParam("date_now", $date_now, PDO::PARAM_STR);
                $stmt->execute();

                $stmt = $db->prepare("INSERT INTO army(village_id, user_id) VALUES (:village_id, :uid)");
                $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
                $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
                $stmt->execute();
                $db = null;

                return true;
            }
            else
                return false;
        }
        catch(PDOException $e)
        {
            echo 'Error on firstLogin: '. $e->getMessage() .'}}';
        }
    }



    public function userDetails($uid)
    {
        try
        {
            $db = getDB();
            $stmt=$db->prepare("SELECT email, username FROM users WHERE uid=:uid");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            return $data;
        }
        catch(PDOException $e)
        {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

    public function villageDetails($uid)
    {
        try
        {

        }
        catch(PDOException $e)
        {
            echo 'Error on villageDetails function: '. $e->getMessage() .'}}';
        }
    }
}
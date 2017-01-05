<?php

/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 2016-11-27
 * Time: 10:23
 */
class ajax_class
{
    public function mapDrawing()
    {
        try
        {
            $db = getDB();
            $stmt = $db->prepare("SELECT map_position FROM map");
            $stmt->execute();
            $data = $stmt->fetchALL(PDO::FETCH_OBJ);
            $db = null;
            return $data;

        }
        catch(PDOException $e)
        {
            echo 'Error on function mapDrawing: '. $e->getMessage() .'}}';
        }
    }

    public function villageOwner($uid)
    {
        try
        {
            $db = getDB();
            $stmt = $db->prepare("SELECT map_position FROM map WHERE user_id=:uid");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function villageOwner: ' . $e->getMessage() . '}}';
        }
    }

    public function showInfo($index)
    {
        try
        {
            $db = getDB();
            $stmt = $db->prepare("SELECT user_id, points, village_name FROM map WHERE map_position=:index");
            $stmt->bindParam("index", $index, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function showInfo ajax: ' . $e->getMessage() . '}}';
        }
    }


    public function generalInfoUser($uid)
    {
        try
        {
            $db = getDB();
            $stmt = $db->prepare("SELECT username FROM users WHERE uid=:uid");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function generalInfoUser ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function generalInfoMap($uid)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT points, village_name FROM map WHERE user_id=:uid");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function generalInfoMap ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function getVillageId($uid)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT village_id FROM map WHERE user_id=:uid");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function getVillageId ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function amountBelt($village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT wood, stone, food, population, last_check FROM amount WHERE village_id=:village_id");
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function amountBelt ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function displayBuildings($village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT * FROM buildings WHERE village_id=:village_id");
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on functiondisplayBuildings ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function increaseLevel($place, $levele, $village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("UPDATE buildings SET ".$place."=:levele WHERE village_id=:village_id");
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->bindParam("levele", $levele, PDO::PARAM_INT);
            $stmt->execute();



            return $levele;
        }
        catch(PDOException $e)
        {
            echo 'Error on functiondisplayBuildings ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function getLevel($village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT * FROM buildings WHERE village_id=:village_id");
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function getLevel ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function updateAmount($wood, $stone, $food, $population, $now_time, $village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("UPDATE amount SET wood=:wood, stone=:stone, food=:food, population=:population, last_check=:now_time WHERE village_id=:village_id");
            $stmt->bindParam("wood", $wood, PDO::PARAM_INT);
            $stmt->bindParam("stone", $stone, PDO::PARAM_INT);
            $stmt->bindParam("food", $food, PDO::PARAM_INT);
            $stmt->bindParam("population", $population, PDO::PARAM_INT);
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->bindParam("now_time", $now_time, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo 'Error on function updateAmount ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function displayBarrack($village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("SELECT * FROM army WHERE village_id=:village_id");
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_OBJ);

            $db = null;
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            echo 'Error on function displayBarrack ajax: ' . $e->getMessage() . '}}';
        }
    }

    public function updateArmy($Miecznik, $Lucznik, $village_id)
    {
        try
        {
            $db = getDB();

            $stmt = $db->prepare("UPDATE army SET Miecznik=:Miecznik, Lucznik=:Lucznik WHERE village_id=:village_id");
            $stmt->bindParam("Miecznik", $Miecznik, PDO::PARAM_INT);
            $stmt->bindParam("Lucznik", $Lucznik, PDO::PARAM_INT);
            $stmt->bindParam("village_id", $village_id, PDO::PARAM_INT);

            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo 'Error on function updateAmount ajax: ' . $e->getMessage() . '}}';
        }
    }

}
<?php
namespace Models;
class LeaderBoard
{
    public static function db()
    {   try{
        include __DIR__."/../../configs/credentials.php";
        return new \PDO("mysql:dbname=".
        $db_connect['db_name'].";host=". 
        $db_connect['server'] , 
        $db_connect['username'] ,
        $db_connect['password']

        );
        }
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
    }

    public static function showboard()
    {
        try{
            $db = self::db();
            $stmt = $db->query("SELECT * FROM LeaderBoard");
        while ($row = $stmt->fetch())
        {
                $quiz[$i][0] = $row['username'];
                $quiz[$i][1] = $row['score'];
                $quiz[$i][2] = $row['quiz'];
                $i++;
        }
            return $quiz;
        }
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
    }
}
?>
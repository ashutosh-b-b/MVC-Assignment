<?php
namespace Models;
class Signup
{
    public static function db()
    {
        include __DIR__."/../../configs/credentials.php";
        return new \PDO("mysql:dbname=".
        $db_connect['db_name'].";host=". 
        $db_connect['server'] , 
        $db_connect['username'] ,
        $db_connect['password'] );
    }
    public static function user_add($username, $password)
    {
        $db = self::db();
        $sql = "INSERT INTO Users (username, password, role) VALUES(:username , :password , :role)";
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                ':username' => $username,
                ':password' => $password,
                ':role' => "user"
                
                )
            );
    }
}
?>
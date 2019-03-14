<?php

namespace Models;
class Login
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
    public static function Check_user($username, $password, $role)
    {
        $db = self::db();
        $sql = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND role = :role");
        $data = $sql->execute(
            array(
                ":username" => $username,
                ":password" => $password,
                ":role" => $role

            )
        );
        $row = $sql->fetch(\PDO::FETCH_ASSOC);
    
        if($row)
        {
            return true;
        }
        else return false;
        
    }
}

?>
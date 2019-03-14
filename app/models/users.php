<?php

namespace Models;
class users
{
    public static function db()
    {
        try{
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
        public static function Check_user($username, $password, $role)
        {   try{
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
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
        
    }

    public static function user_add($username, $password)
    {   try{
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
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
    }

    public static function username_check($username)
    {
        try{
            $db = self::db();
            $sql = $db->prepare("SELECT * FROM users WHERE username = :username ");
            $data = $sql->execute(
                array(
                    ":username" => $username,                    
                )
            );
            $row = $sql->fetch(\PDO::FETCH_ASSOC);
          
            if($row)
            {
                return true;
            }
            else return false;
            }
            catch(Exception $e)
            {
                echo "Sorry we are undermaintainance";
            }
    }
}

?>
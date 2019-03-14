<?php
namespace Models;
class AddQ
{
    public static function db()
    {
        include __DIR__."/../../configs/credentials.php";
        return new \PDO("mysql:dbname=".
        $db_connect['db_name'].";host=". 
        $db_connect['server'] , 
        $db_connect['username'] ,
        $db_connect['password']

        );
    }
    public static function add_question($quesion, $ans ,$op1 , $op2 , $op3, $op4, $quiz)
    {
        $db = self::db();
        $sql = "INSERT INTO Questions(question, ans, op1, op2, op3, op4, quiz) VALUES (:question, :ans, :op1, :op2 , :op3, :op4, :quiz) ";
        $stmt = $db->prepare($sql);
        $stmt->execute(
                array(
                        ":question" => $quesion,
                        ":ans" => $ans,
                        ":op1" => $op1,
                        ":op2" => $op2,
                        ":op3" => $op3,
                        ":op4" => $op4,
                        ":quiz" => $quiz
                    )
        );
    }
    public static function quiz_names()
    {
        $db = self::db();
        $stmt = $db->query("SELECT Distinct quiz FROM Questions");
    while ($row = $stmt->fetch())
    {
            $quiz[$i] = $row['quiz'];
            $i++;
    }
        return $quiz;
    }
    
    // public static function return_arr()
    // {
    //     $a[0] = "Aditya";
    //     $a[1] = "Akshat";
    //     return $a;
    // }
    
}
?>
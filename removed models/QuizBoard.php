<?php
namespace Models;
class QuizBoard
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
    
    public static function question_arr($quizname)
    {   $questions = array();
        $db = self::db();
        $stmt = $db->prepare("SELECT * FROM Questions Where quiz = :quiz");
        $stmt->execute(array(
            ":quiz" => $quizname
        ));
        $i = 0;
        while ($row = $stmt->fetch())
    {       
            $quiz[$i][0] = $row['question'];
            $quiz[$i][1] = $row['op1'];
            $quiz[$i][2] = $row['op2'];
            $quiz[$i][3] = $row['op3'];
            $quiz[$i][4] = $row['op4'];
            $i++;
    }
        return $quiz;
    }
    
    public static function quiz_names()
    {
        $db = self::db();
        $stmt = $db->query("SELECT * FROM Questions");
    while ($row = $stmt->fetch())
    {
            $quiz[$i] = $row['quiz'];
            $i++;
    }
        return $quiz;
    }

    public static function ans_checker($resp, $quiz_name2)
    {    $resp = json_decode($resp);
            
         $score = 0;
        $db = self::db();
        $stmt = $db->prepare("SELECT * FROM Questions Where quiz = :quiz");
        $stmt->execute(array(
            ":quiz" => $quiz_name2
        ));
        $i = 0;
        
        while ($row = $stmt->fetch())
        {         
           if($resp[$i]+1 == $row["ans"])
           {    
               $score++;
           }
        }
        return $score;
        
    }
    public static function update_scores($username, $score, $quizname)
    {
        $db = self::db();
        $sql = "INSERT INTO Leaderboard (username, score, quiz) VALUES(:username , :score , :quiz)";
        $stmt = $db->prepare($sql);
        $stmt->execute(
            array(
                ':username' => $username,
                ':score' => $score,
                ':quiz' => "$quizname"
                
                )
            );
       
    }
    
}

?>
<?php
namespace Models;
class Questions
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
    public static function add_question($quesion, $ans ,$op1 , $op2 , $op3, $op4, $quiz)
    {   try{
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
    catch(Exception $e)
    {
        echo "Sorry we are undermaintainance";
    }
}
    public static function quiz_names()
    {   try{
        $db = self::db();
        $stmt = $db->query("SELECT Distinct Quizes.quizid, Questions.quizid, Quizes.Quizname
        FROM Questions
        INNER JOIN Quizes ON Quizes.quizid=Questions.quizid;");
        
        while ($row = $stmt->fetch())
        {   
            $quiz[$i] = $row['Quizname'];
            $i++;
        }
        return $quiz;
    }
    catch(Exception $e)
    {
        echo "Sorry we are undermaintainance";
    }
    }
    
    public static function question_arr($quizname)
    {   try{
        $questions = array();
        $db = self::db();
        $stmt = $db->prepare("SELECT *
        FROM Questions
        INNER JOIN Quizes ON Questions.quizid=Quizes.quizid
        Where Quizes.Quizname = :quiz ");
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
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
    }   
    
    

    public static function ans_checker($resp, $quiz_name2)
    {   try{ 
        $resp = json_decode($resp);
            
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
        catch(Exception $e)
        {
            echo "Sorry we are undermaintainance";
        }
    }
    public static function update_scores($username, $score, $quizname)
    {   try{
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
    catch(Exception $e)
    {
        echo "Sorry we are undermaintainance";
    }
}
    
}
?>
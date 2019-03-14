<?php
namespace Controllers;
use Models\Questions;
class AddQController
{
    protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
        public function get()
        {   session_start();
            
            if($_SESSION['role'] == 'admin')
            {$a = array();
            //$a = AddQ::return_arr();
            $b = Questions::quiz_names();
            echo $this->twig->render("AddQ.html", array(
                "title" => "Add Your Question",  
                "arr" => $a,
                "quizes" => $b       
                )) ;
            }
            else 
            echo $this->twig->render("AddQ.html", array(
                "title" => "Add Your Question",  
                "error" => "true"      
                )) ;

        }
        public function post()
        {   
            $question = $_POST['question'];
            $ans = $_POST['answer'];
            $op1 = $_POST['op1'];
            $op2 = $_POST['op2'];
            $op3 = $_POST['op3'];
            $op4 = $_POST['op4'];
            $quiz = $_POST['quiz'];
            Questions::add_question($question, $ans, $op1, $op2, $op3, $op4,$quiz );
            header("Location: /");
        }
}
?>
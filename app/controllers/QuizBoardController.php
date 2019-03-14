<?php
    namespace Controllers;
    use Models\Questions;
    class QuizBoardController
    {
        protected $twig;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
        $this->twig = new \Twig_Environment($loader) ;
    }
    public function get()
    {   session_start(); 
        if($_SESSION['username'] != NULL)
        {
        $quiz =  Questions::quiz_names();

        echo $this->twig->render("quizboard.html", array(
            "title" => "Quiz",
            "quizes" => $quiz
            )) ;
        }
        else
        {
            echo $this->twig->render("quizboard.html", array(
                "title" => "Quiz",
                "error" => 'true'
                )) ;
        }
    }
    
    public function post()
    {
        if($_POST["ans"] == NULL )
        {   $quizname = $_POST['quizname'];
            $questions = Questions::question_arr($quizname);
            echo $this->twig->render("quizboard.html", array(
                "quizname" => $quizname,
                "q" => $questions,
                "bool" => 1

                )) ;
        }
        else
        {   $resp = $_POST["ans"];
            $quiz_name = $_POST["quiz_name2"];
            $score = Questions::ans_checker($resp, $quiz_name);
            
            $username = $_SESSION["username"] ;
            Questions::update_scores($username, $score, $quiz_name);
            header("Location: /");
        }
    }

    }
?>
<?php
    namespace Controllers;
    use Models\LeaderBoard;
    class LeaderBoardController
    {
        protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
        public function get()
        {   $a = LeaderBoard::showboard();

            echo $this->twig->render("Leaderboard.html", array(
                "title" => "SignUp",
                "board" => $a
                )) ;
        }
    }
?>
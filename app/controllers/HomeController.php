<?php
namespace Controllers;
class HomeController
{
    protected $twig;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
    }
    public function get()
    {  session_start();

         if($_SESSION["username"] == NULL)
       { echo $this->twig->render("home.html", array(
            "title" => "Quizer")) ;}
        else
        {
            echo $this->twig->render("home2.html", array(
                "title" => "Quizer")) ; 
        }
        
    }
    public function post()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }
}
?>
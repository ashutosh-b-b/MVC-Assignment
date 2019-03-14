<?php
namespace Controllers;
use Models\users;
class LoginController
{   protected $twig;
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
        $this->twig = new \Twig_Environment($loader) ;
    }
    public function get()
    {
        echo $this->twig->render("Login.html", array(
            "title" => "Login")) ;
    }
    public function post()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        if(users::Check_user($username, $password, $role))
        {   session_start();    
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;
            header("Location: /");
        }
        else {
            echo $this->twig->render("Login.html", array(
                "title" => "Login",
                "error"=>"Invalid Username or Password"
            )) ;
        }
        
    }
}
?>
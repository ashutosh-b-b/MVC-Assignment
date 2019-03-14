<?php
namespace Controllers;
use Models\users;
class SignupController
{
    protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
        public function get()
        {
            echo $this->twig->render("Signup.html", array(
                "title" => "SignUp")) ;
        }
        public function post()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $flag = users::username_check($username);
         
            if($flag == true)
            {  
                echo $this->twig->render("Signup.html", array(
                    "signuperror" => "true")) ;
                    
            }
            else
            {
            users::user_add($username , $password);
            header("Location: /");
        }
        }
}
?>
<?php
require "./controllers/back/Security.class.php";
require "./models/back/admin.manager.php";

class AdminController{
    private $adminManager;
    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function getPageLogin(){       
        require_once "views/login.view.php";
    }
    public function connection(){
        
        //password_hash("admin09", PASSWORD_DEFAULT); 
        // va chercher la methode la plus récente d'encryptage de password
       if(!empty($_POST['login']) && !empty($_POST['password'])){
       
           $login =  Security::secureHTML($_POST['login']);
           $password = Security::secureHTML($_POST['password']);
           if($this->adminManager->isValidConnection($login, $password)){
            $_SESSION['access'] = "admin";
            header('Location: '.URL."back/admin");
           }else{           
            header('Location: '.URL."back/login");
           }
       }
    }
    public function getAccueilAdmin(){
        if(Security::checkAccessSession()){
            require "views/accueilAdmin.view.php";
        }else{
           header(('Location: '.URL."back/login"));
        }
       
    }
    public function logout(){
        session_destroy();
        header('Location: '.URL."back/login");
    }
}
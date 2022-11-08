<?php

class Security{
    public static function secureHTML($string){
        return htmlentities($string);
    }
    public static function checkAccessSession(){
        return (!empty($_SESSION['access']) && $_SESSION['access'] === "admin");     
    }
}
?>
<?php

abstract class Model{
    private static $pdo;

    public static function setBdd(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=dbanimaux;charset=utf8","root","");
        /* self::$pdo = new PDO("mysql:host=db5009944144.hosting-data.io;dbname=dbs8431336;charset=utf8","dbu2097522","BaseDeDonneesDuParc!#"); */
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    protected function getBdd(){
        if(self::$pdo === null){
            self::setBdd();
        }
        return self::$pdo;
    }
    public static function sendJSON($info){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode($info);
    }
}
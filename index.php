<?php 
//http://localhost/...
//https://www.h2prog.com/...
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// recup fichiers
require_once "controllers/front/API.controller.php";
$ApiController = new APIController();

try {
    echo "la page ".URL. $_GET['page'];
    
    if(empty($_GET['page'])){
        throw new Exception("La page n'existe pas");
    }else{
        // le "explode" Génère un tableau
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        if(empty($url[0]) || empty($url[1])){
            throw new Exception("url vide");
        }
        switch ($url[0]) {
            case 'front':

                switch ($url[1]) {
                   
                    case 'animaux':
                        if(!isset($url[2]) || !isset($url[3])){
                        $ApiController->getAnimaux(-1, -1);
                        }else{
                            $ApiController->getAnimaux((int)$url[2], (int)$url[3]);
                        }
                        break;
                        case 'animal':
                        if(empty($url[2])) throw new Exception("Identifiant incorrect");
                        $ApiController->getAnimal($url[2]);
                        break;
                        case 'continents':
                        $ApiController->getContinents();
                        break;
                        case 'familles':
                        $ApiController->getFamilles();
                        break;
                    
                    default:
                        throw new Exception("La page demandée n'existe pas");
                        break;
                }
                break;
            case 'back':
                echo "Le back";
                break;
            
            default:
                throw new Exception("La page n'existe pas dans le switch");
                break;
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}


<?php 
session_start(); // pour les variables de session
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

// recup fichiers
require_once "controllers/front/API.controller.php";
require_once "controllers/back/admin.controller.php";
require_once "controllers/back/famille.controller.php";

$ApiController = new APIController();
$adminController = new AdminController();
$familleController = new FamilleController();

try {    
    
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
                        case 'sendMessage':
                            $ApiController->sendMessage();
                        break;
                    
                    default:
                        throw new Exception("La page demandée n'existe pas");
                        break;
                }
                break;
            case 'back':
                switch ($url[1]) {
                    case 'login':
                        $adminController->getPageLogin();
                        break;
                    case 'connection':
                        $adminController->connection();
                        break;
                    case 'admin':
                        $adminController->getAccueilAdmin();
                        break;
                    case 'logout':
                        $adminController->logout();
                        break;
                    case 'familles':
                        switch ($url[2]) {
                            case 'visualisation':
                                $familleController->visualisation();
                                break;
                            case 'creation':
                                $familleController->creationFamilleTemplate();      
                            break;
                            case 'creationFamilleValidation':
                                $familleController->createFamilly(); 
                            break;
                            case 'validationSuppression':
                                $familleController->supprimerFamille();
                                break;
                                
                            case 'validationModification':
                                $familleController->modifierFamille();
                                break;
                            default: throw new Exception("La page n'existe pas");
                        }
                        
                        break;
                        default:
                        throw new Exception("La page n'existe pas");
                        break;
                    }
                
            break;
            default:
                throw new Exception("La page n'existe pas dans le switch");
                break;
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
    echo "<a href='".URL."back/login'>login</a>";
}


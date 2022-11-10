<?php
require_once "./controllers/back/Security.class.php";
require_once "./models/back/famille.manager.php";

class FamilleController{
    private $familleManager;
    public function __construct()
    {
     $this->familleManager = new FamilleManager();   
    }
   
    public function createFamilly(){
        
        if(Security::checkAccessSession()){
            $familleLibelle = Security::secureHTML($_POST['famille_libelle']);
            $familleDescription = Security::secureHTML($_POST['famille_description']);
            $idFamille = $this->familleManager->createFamille($familleLibelle, $familleDescription);
            $_SESSION['alert'] = [
                "message"=>"La famille a bien été créée avec l'identifiant " .$idFamille,
                "type"=>"alert-success"
            ];
            header('Location: '.URL.'back/familles/visualisation');
        }else{
            throw new Exception("Vous devez vous connecter pour créer une famille");
        }
        
    }
    public function creationFamilleTemplate(){
        if(Security::checkAccessSession()){
            require_once "views/familleCreation.view.php";  
        }else{
            throw new Exception("Vous devez vous connecter pour créer une famille");
        }        
    }
    public function modifierFamille(){
        if(Security::checkAccessSession()){
            $familleId = (int)Security::secureHTML($_POST['famille_id']);
            $familleLibelle = Security::secureHTML($_POST['famille_libelle']);
            $familleDescription = $_POST['famille_description'];
            $responseLibelle = $this->familleManager->updateFamille($familleId, $familleLibelle, $familleDescription);
            
            $_SESSION['alert'] = [
                "message" => "La famille ". $responseLibelle['famille_libelle'] . " a bien été modifiée",
                "type"=> "alert-success"
            ];
           header('Location: '.URL.'back/familles/visualisation');
        }else{
            throw new Exception("Vous n'avez pas le droit d'etre là");
        }
    }
    public function supprimerFamille(){
        if(Security::checkAccessSession()){
        
        $familleId = (int)Security::secureHTML($_POST['famille_id']); 
        if($this->familleManager->countAnimals($familleId ) > 0){
             // gestion des erreurs
             $_SESSION['alert'] = [
                "message"=> "La famille n'a pas été supprimée, elle contient des animaux",
                "type"=> "alert-danger"
            ];
            
        }else{
            $this->familleManager->deleteDbFamille((int)Security::secureHTML($familleId ));
            
            // gestion des erreurs
            $_SESSION['alert'] = [
                "message"=> "La famille a été supprimée",
                "type"=> "alert-success"
            ];
           
        }
        header('Location: '.URL.'back/familles/visualisation');
    }else{
        throw new Exception("Vous n'avez pas le droit d'etre là");
    }
}
    public function visualisation(){
        if(Security::checkAccessSession()){
            $familles = $this->familleManager->getFamilles();
            require_once "views/famillesList.view.php";
        }else{
            throw new Exception("Vous n'avaez ps accès à cette page");
        }
    }
}
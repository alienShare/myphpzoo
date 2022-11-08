<?php
require_once "./controllers/back/Security.class.php";
require_once "./models/back/famille.manager.php";

class FamilleController{
    private $familleManager;
    public function __construct()
    {
     $this->familleManager = new FamilleManager();   
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
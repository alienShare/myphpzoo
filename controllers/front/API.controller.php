<?php
 require_once "models/front/API.manager.php";
require_once "models/Model.php";

 class APIController{
   private $apiManager;

   public function __construct(){
       $this->apiManager = new APIManager();
   }

    public function getAnimaux($idFamille, $idContinent){
        $lignesAnimaux = $this->apiManager->getDBAnimaux($idFamille, $idContinent);
        $rep = $this->formatDataLignesAnimaux($lignesAnimaux);
        Model::sendJSON($rep);
    }
    public function getAnimal($idAnimal){
        $lignesAnimal = $this->apiManager->getDBAnimal(($idAnimal));
        $rep = $this->formatDataLignesAnimaux($lignesAnimal, $_SERVER);
        Model::sendJSON($rep);
    }
    private function formatDataLignesAnimaux($lignes){
        
        $tab=[];
       
        foreach ($lignes as $ligne){
            if(!array_key_exists($ligne["animal_id"], $tab)){           
                $tab[$ligne["animal_id"]] = [
                    "id"=>$ligne["animal_id"],
                    "nom"=>$ligne["animal_nom"],
                    "description"=>$ligne["animal_description"],
                    "image"=>URL."public/images/".$ligne["animal_image"],
                    "famille"=>[
                        "idFamille"=>$ligne["famille_id"],
                        "libelleFamille"=>$ligne["famille_libelle"],
                        "descriptionFamille"=>$ligne["famille_description"]
                    ]
    
                ];
               
            }
            
            $tab[$ligne["animal_id"]]["continents"][] = [
                "idContinent"=>$ligne["continent_id"],
                "libelleContinent"=>$ligne["continent_libelle"]
            ];
           
        }
        return $tab;
    }
    public function getContinents(){
        $continents = $this->apiManager->getDBContinents();
        Model::sendJSON($continents);
    }
    public function getFamilles(){       
        $families = $this->apiManager->getDBFamilles();
        Model::sendJSON($families);

    }
}
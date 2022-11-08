<?php
require_once "models/Model.php";

class FamilleManager extends Model{
    public function __construct()
    {
        
    }
    public function getFamilles(){
        $req = "SELECT * FROM famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $familles;
    }
    public function countAnimals($familleId){
        $req = "SELECT COUT(*)AS 'NB'
        FROM famille f inner join animal a on a.famille_id = f.famille_id
        WHERE f.famille_id = :familleId";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue("familleId", $familleId, PDO::PARAM_INT);
        $stmt->execute();
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $response['nb'];
        
    }
    public function deleteDbFamille($familleId){
        $req = "DELETE FROM famille WHERE famille_id= :familleId";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":familleId", $familleId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
      
    }
}
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
    public function createFamille($familleLibelle, $familleDescription){
        $req = "INSERT INTO famille (famille_libelle,famille_description)
        VALUES (:familleLibelle, :familleDescription)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":familleLibelle", $familleLibelle, PDO::PARAM_STR);
        $stmt->bindValue("familleDescription", $familleDescription, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();       
        return $this->getBdd()->lastInsertId();
    }
    public function updateFamille($familleId, $familleLibelle, $familleDescription){
        $req = "UPDATE famille 
        SET famille_libelle = :familleLibelle,
        famille_description = :familleDescription
        WHERE famille_id= :familleId;        
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":familleId", $familleId, PDO::PARAM_INT);
        $stmt->bindValue(":familleLibelle", $familleLibelle, PDO::PARAM_STR);
        $stmt->bindValue(":familleDescription", $familleDescription, PDO::PARAM_STR);
        $stmt->execute();        
        $stmt->closeCursor();   
        $resLibelle = $this->getFamillyFromId($familleId);
        return $resLibelle;
    }
    public function getFamillyFromId($familleId){
        $req = "SELECT famille_libelle FROM famille
        WHERE famille_id= :familleId";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":familleId", $familleId, PDO::PARAM_INT);
        $stmt->execute();
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();        
        return $response;
    }
    public function deleteDbFamille($familleId){
        $req = "DELETE FROM famille WHERE famille_id= :familleId";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":familleId", $familleId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
      
    }
}
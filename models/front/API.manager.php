<?php

require_once "models/Model.php";

class APIManager extends Model{
    public function getDBAnimaux($idFamille, $idContinent){
        $whereClause="";
        if ($idFamille !== -1 || $idContinent !== -1) $whereClause .= "WHERE ";
        if ($idFamille !== -1) $whereClause .= "f.famille_id = :idFamille";
        if ($idFamille !== -1 && $idContinent !== -1) $whereClause .= " AND ";
        if ($idContinent !== -1) $whereClause .= "a.animal_id IN (
                SELECT animal_id FROM animal_continent WHERE continent_id = :idContinent
            )";
        $req = "SELECT * FROM animal a 
        inner join famille f on a.famille_id = f.famille_id
        inner join animal_continent ac on ac.animal_id = a.animal_id
        inner join continent c on c.continent_id = ac.continent_id ".$whereClause;
        $stmt = $this->getBdd()->prepare($req);
        if($idFamille !== -1) $stmt->bindValue(':idFamille', $idFamille, PDO::PARAM_INT);
        if($idContinent !== -1) $stmt->bindValue(':idContinent', $idContinent);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;
    }
    public function getDBAnimal($animalId){
        $req = "SELECT * FROM animal a 
        inner join famille f on a.famille_id = f.famille_id
        inner join animal_continent ac on ac.animal_id = a.animal_id
        inner join continent c on c.continent_id = ac.continent_id
        WHERE a.animal_id = :animalId";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":animalId", $animalId, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesAnimal;
    }
    public function getDBFamilles(){
        $req = "SELECT * FROM famille f";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $theFamily = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $theFamily;
    }
    public function getDBContinents(){
        $req = "SELECT * FROM continent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $continents;
    }
}
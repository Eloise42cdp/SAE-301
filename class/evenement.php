<?php
class Evenement{
    private $conn;
    
    public $id;
    public $nom_evenement;
    public $date_de_debut;
    public $date_de_fin;
    public $lieu;
    public $JouerType;

    public function __construct($db, $nom_evenement, $date_de_debut, $date_de_fin, $lieu, $JouerType) {
        $this->conn = $db;
        $this -> nom_evenement = $nom_evenement;
        $this -> date_de_debut = $date_de_debut;
        $this -> date_de_fin = $date_de_fin;
        $this -> lieu = $lieu; 
        $this -> JouerType = $JouerType; 
    }

    
    public function ajoutEvent (){
        $query='INSERT INTO evenement (nom, datedebut, datefin, adresse) VALUES (:nom, :datedebut, :datefin, :lieu)';	
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nom', $this->nom_evenement);
        $stmt->bindParam(':datedebut', $this->date_de_debut);
        $stmt->bindParam(':datefin', $this->date_de_fin);
        $stmt->bindParam(':lieu', $this->lieu);

        if ($stmt->execute()) {
            // on ajouter les jointures de JouerType
            $Id_Evenement = $this->conn->lastInsertId();

            foreach ($this->JouerType as $value) {
                $query = "INSERT INTO evenementtype (Id_Evenement, Id_JouerType) VALUES (:Id_Evenement, :Id_JouerType)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':Id_Evenement',$Id_Evenement);
                $stmt->bindParam(':Id_JouerType', $value);
                $stmt->execute();
            }
            
            echo "Événement ajouté avec succès !";

        }else {
            echo "Erreur lors de l'ajout de l'événement.";
        }
    }
}

?>

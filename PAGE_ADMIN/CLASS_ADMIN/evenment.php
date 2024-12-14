<?php
class Evenement{
    private $conn;
    private $table_name = "evenements";

    public $id;
    public $nom_evenement;
    public $date_de_debut;
    public $date_de_fin;
    public $lieu;

    public function __construct($db, $nom_evenement, $date_de_debut, $date_de_fin, $lieu) {
        $this->conn = $db;
        $this -> nom_evenement = $nom_evenement;
        $this -> date_de_debut = $date_de_debut;
        $this -> date_de_fin = $date_de_fin;
        $this -> lieu = $lieu; 
    }

    
    public function ajoutEvent (){
        $actionsBDD = Database::getConnection():

        $sql='INSERT INTO evenement (adresse, dateDebut, dateFin, nom)
        VALUES (:adresse, )';	
        $param = [
            ':lieu'=> $this->lieu,
            ':date_de_debut'=> $this->date_de_debut,
            ':date_de_fin'=> $this->date_de_fin,
            ':nom_evenement'=> $this->nom_evenement,
        ];
        $result = $actionsBDD->insertDonnees($sql, $param);
    }
}

?>

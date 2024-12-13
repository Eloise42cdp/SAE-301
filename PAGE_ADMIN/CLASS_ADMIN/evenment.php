<?php
class evenement{
    private $conn;
    private $table_name = "evenements";

    public $id;
    public $nom_evenement;
    public $date_de_debut;
    public $date_de_fin;
    public $lieu;

    public function __construct($nom_evenement, $date_de_debut, $date_de_fin, $lieu) {
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
            ':adresse'=> $this->lieu,
            ':dateDebut'=> $this->date_de_debut,
            ':dateFin'=> $this->date_de_fin,
            ':nom'=> $this->nom_evenement,
        ];
        $result = $actionsBDD->insertDonnees($sql, $param);
    }
}

?>

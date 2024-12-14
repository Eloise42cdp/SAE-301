<?php
class Evenement{
    private $conn;
    private $table_name = "evenements";

    public $id_Evenement;
    public $nom;
    public $dateDebut;
    public $date_de_fin;
    public $adresse;

    public function __construct($db, $nom, $dateDebut, $dateFin, $adresse) {
        $this -> conn = $db;
        $this -> nom = $nom;
        $this -> dateDebut = $dateDebut;
        $this -> dateFin = $dateFin;
        $this -> adresse = $adresse; 
    }

    
    public function ajoutEvent (){
        $database = new Database();
        $actionsBDD = $database->getConnection();  // Appel de la méthode d'instance

        $sql='INSERT INTO evenement (nom, dateDebut, dateFin, adresse)
        VALUES (:nom, :dateDebut, :dateFin, :adresse)';	
        $param = [
            ':nom' => $this->nom,
            ':dateDebut' => $this->dateDebut,
            ':dateFin' => $this->dateFin,
            ':adresse' => $this->adresse,
        ];
        $result = $actionsBDD->insertDonnees($sql, $param);

        if ($result) {
            echo "Événement ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout de l'événement.";
        }
        
    }
    public function modifierEvent($id) {
        $actionsBDD = Database::getConnection();
    
        $sql = 'UPDATE evenement SET nom = :nom, dateDebut = :dateDebut, dateFin = :dateFin, adresse = :adresse WHERE id_Evenement = :id_Evenement';
    
        $param = [
            ':nom' => $this->nom,
            ':dateDebut' => $this->dateDebut,
            ':dateFin' => $this->dateFin,
            ':adresse' => $this->adresse,
            ':id_Evenement' => $id_Evenement,
        ];
    
        $result = $actionsBDD->insertDonnees($sql, $param);
    
        if ($result) {
            echo "Événement modifié avec succès !";
        } else {
            echo "Erreur lors de la modification de l'événement.";
        }
    }
    public function supprimerEvent($id) {
        // Connexion à la base de données
        $actionsBDD = Database::getConnection();
    
        // SQL pour supprimer un événement
        $sql = 'DELETE FROM evenement WHERE id_Evenement = :id_Evenement';
    
        // Paramètre pour la requête
        $param = [
            ':id_Evenement' => $id,
        ];
    
        // Exécution de la requête
        $result = $actionsBDD->insertDonnees($sql, $param);
    
        // Vérification si la suppression a réussi
        if ($result) {
            echo "Événement supprimé avec succès !";
        } else {
            echo "Erreur lors de la suppression de l'événement.";
        }
    }
    
}

?>

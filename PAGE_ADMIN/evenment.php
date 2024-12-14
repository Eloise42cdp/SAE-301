<?php
require_once 'database.php';
class Evenement{
    private $conn;
    private $table_name = "evenement";

    public $id_Evenement;
    public $nom;
    public $dateDebut;
    public $date_de_fin;
    public $adresse;

    // Constructeur de la classe
    public function __construct($db, $nom, $dateDebut, $dateFin, $adresse) {
        $this->conn = $db; // Connexion à la base de données
        $this->nom = $nom;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->adresse = $adresse;
    }

    
    public function ajoutEvent (){
        $database = new database();
        $actionsBDD = $database->getConnection();  // Appel de la méthode d'instance

        $sql='INSERT INTO evenement (nom, dateDebut, dateFin, adresse)
        VALUES (:nom, :dateDebut, :dateFin, :adresse)';	
        $param = [
            ':nom' => $this->nom,
            ':dateDebut' => $this->dateDebut,
            ':dateFin' => $this->dateFin,
            ':adresse' => $this->adresse,
        ];

        // Préparer la requête
        $stmt = $actionsBDD->prepare($sql);
    
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute($param);

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
    
        // Préparer la requête
        $stmt = $actionsBDD->prepare($sql);
    
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute($param);
    
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
    
        // Préparer la requête
        $stmt = $actionsBDD->prepare($sql);
    
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute($param);
    
        // Vérification si la suppression a réussi
        if ($result) {
            echo "Événement supprimé avec succès !";
        } else {
            echo "Erreur lors de la suppression de l'événement.";
        }
    }
    
}

?>

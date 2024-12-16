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
    public function __construct($db, $ville, $adresse, $lagitude, $longitude) {
        $this->conn = $db; // Connexion à la base de données
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->lagitude = $lagitude;
        $this->longitude = $longitude;
    }

    
    public function ajoutEvent (){
        $database = new database();
        $actionsBDD = $database->getConnection();  // Appel de la méthode d'instance

        $sql='INSERT INTO evenement (ville, adresse, lagitude, longitude)
        VALUES (:ville, :adresse, :lagitude, :longitude)';	
        $param = [
            ':ville' => $this->ville,
            ':adresse' => $this->adresse,
            ':lagitude' => $this->lagitude,
            ':longitude' => $this->longitude,
        ];

        // Préparer la requête
        $stmt = $actionsBDD->prepare($sql);
    
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute($param);

        if ($result) {
            echo "Point de collecte ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du point de collecte.";
        }
        
    }
    
    
    public function supprimerEvent($id) {
        $database = new database();
        $actionsBDD = $database->getConnection();
    
        // SQL pour supprimer un événement
        $sql = 'DELETE FROM collecte WHERE Id_collecte = :Id_collecte';
    
        // Paramètre pour la requête
        $param = [
            ':Id_collecte' => $Id_collecte,
        ];
    
        // Préparer la requête
        $stmt = $actionsBDD->prepare($sql);
    
        // Exécuter la requête avec les paramètres
        $result = $stmt->execute($param);
    
        // Vérification si la suppression a réussi
        if ($result) {
            echo "Point de Collecte supprimé avec succès !";
        } else {
            echo "Erreur lors de la suppression du point de collecte.";
        }
    }
    
}

?>

<?php
require_once 'database.php';

class Collecte{
    private $conn;
    private $table_name = "collecte";

    public $ville;
    public $adresse;
    public $latitude;
    public $longitude;
    public $couleur;

    // Constructeur de la classe
    public function __construct($db, $ville, $adresse, $latitude, $longitude, $couleur){
        $this->conn = $db; // Connexion à la base de données
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->couleur = $couleur;
    }

    
    public function ajoutCollecte (){
        $database = new database();
        $actionsBDD = $database->getConnection(); 

        $sql='INSERT INTO collecte (ville, adresse, latitude, longitude)
        VALUES (:ville, :adresse, :latitude, :longitude)';	
        $param = [
            ':ville' => $this->ville,
            ':adresse' => $this->adresse,
            ':latitude' => $this->latitude,
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
    
    
    public function supprimerCollecte($id) {
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

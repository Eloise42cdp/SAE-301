<?php
namespace Admin;

use PDO;  // Importation de la classe PDO

class Database {
    private $host = "localhost";
    private $db_name = "afaj2";  // Nom de ta base de données
    private $username = "root";  // Nom d'utilisateur de la base de données
    private $password = "";  // Mot de passe de la base de données
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Connexion à la base de données avec PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Définir le mode d'erreur PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// Le code suivant peut être dans un fichier séparé ou dans le même fichier

try {
    // Créer une instance de la classe Database
    $database = new Database();
    // Obtenir la connexion
    $db = $database->getConnection();

    // Requête SQL pour récupérer les données de la table collecte
    $sql = "SELECT ville, adresse, latitude, longitude, couleur FROM collecte";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Récupérer les résultats
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats au format JSON
    echo json_encode($data);

} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

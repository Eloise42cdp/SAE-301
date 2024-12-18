<?php
namespace Admin;

use PDO;  // Importation de la classe PDO

class Database {
    private $host = "localhost";
    private $db_name = "afaj";  // Nom de ta base de données
    private $username = "root";  // Nom d'utilisateur de la base de données
    private $password = "";  // Mot de passe de la base de données
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>

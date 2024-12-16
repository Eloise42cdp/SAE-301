<?php

// Database connection
class Database {
    
    private static $instance = NULL;
    private $connexion;
    private $host = "localhost";
    private $db_name = "afaj";
    private $username = "root";
    private $password = "";
    public $bdd;

    public function getConnection() {
        $this->bdd = null;
        try {
            $this->bdd = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->bdd;
    }

    public function insertDonnees($requete, $params = []) {
        try {
            $stmt = $this->bdd->prepare($requete);
            $stmt->execute($params);
            return $this->bdd->lastInsertId(); // retourne l'ID de la dernière insertion
        } catch (PDOException $e) {
            echo "Échec lors de l'enregistrement des données : " . $e->getMessage();
            return false;
        }
    }
}



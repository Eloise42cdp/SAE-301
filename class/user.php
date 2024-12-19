<?php

// User class for authentication
class User {
    private $bdd;
    public $IdUser;        // ID du membre connecté
    public $role;    // Admin ou Membre

    public function __construct($db) {
        if (!isset($_SESSION)) session_start();
        $this->bdd = $db;
        $this->IdUser = $_SESSION['user_id'] ?? 0;
        

        // on charge les information de l'utilisateur
        $this->setRole();

        //echo "<br>class user";
    }

    private function setRole() {
        $query = "SELECT membretype.nom AS role
                  FROM membre
                  INNER JOIN mt ON membre.Id_Membre = mt.Id_Membre
                  INNER JOIN membretype ON mt.Id_MembreType = membretype.Id_MembreType
                  WHERE membre.Id_Membre = :id";

        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':id', $this->IdUser);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->role = $result['role'] ?? 'membre'; // Par défaut, rôle "membre"
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    // Verifi si le login et passe sont correcte
    public function login($username, $password) {
        $query = "SELECT * FROM membre WHERE email = :email";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(":email", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['mdp'])) {
                // Lier la session à des informations uniques
                // $_SESSION du cote serveur
                // Cookis cote navigateur
                // Liaison entre navigateur et serveur avec PHPSESSID
                session_regenerate_id(true); // Securite Session Cookis
                $_SESSION['user_id'] = $user['Id_membre'];              // ID Membre 
                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];      // Adresse IP de l'utilisateur
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];  // User-Agent du navigateur
                $_SESSION['username'] = $user['nom']." ".$user['prenom'];
                return true;
            }
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
        header("Location: connexion.php");
    }

    // foncton pour charger les information du membre
    // membre connecter est admin ou membre
    // 
    public function GetInfoMembre() {
        $query = "SELECT * FROM membre WHERE email = :email";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(":email", $username);
        $stmt->execute();

        $this->IdUser = $_SESSION['user_id'];
        $this->TypeMembre = "admin";
    }
}



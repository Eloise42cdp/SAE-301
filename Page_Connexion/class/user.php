<?php

// User class for authentication
class User {
    private $bdd;
    private $TypeMembre; // Admin ou Membre

    public function __construct($db) {
        $this->bdd = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM membre WHERE email = :email";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(":email", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['mdp'])) {
                $_SESSION['user_id'] = $user['Id_membre'];
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

    // foncton pour savoir si le membre connecter est admin ou membre
    //public GetTypeMembre() {
        
    //}
}



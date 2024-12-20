<?php

class Membre{
    private $conn;
    private $table_name = "membre";

    public $nom;
    public $prenom;
    public $email;
    public $mdp;
    public $dateNaissance;
    public $tel;

    // Constructeur de la classe
    public function __construct($db, $nom, $prenom, $email, $mdp, $dateNaissance, $tel){
        $this->conn = $db; // Connexion à la base de données
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->dateNaissance = $dateNaissance;
        $this->tel = $tel;
    }

    public function modifierMembre($id) {
    

    $sql = 'UPDATE membre SET nom = :nom, prenom = :prenom, email = :email, mdp = :mdp, dateNaissance = :dateNaissance, tel =:tel WHERE id_Evenement = :id_Evenement';

    $param = [
        ':nom' => $this->nom,
        ':prenom' => $this->prenom,
        ':email' => $this->email,
        ':mdp' => $this->mdp,
        ':dateNaissance' => $this->dateNaissance,
        ':tel' => $this->tel,
        ':id_Evenement' => $id,
    ];

    try {
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($param);

        if ($result) {
            echo "Membre modifié avec succès !";
        } else {
            echo "Erreur lors de la modification du membre.";
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
    
    }  
    // Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['Id_membre'])) {
    $db = new Database();
    $bdd = $db->getConnection();

    // Requête pour récupérer les informations de l'utilisateur
    $stmt = $bdd->prepare("SELECT * FROM membre WHERE Id_membre = :Id_membre");
    $stmt->execute(['Id_membre' => $_SESSION['Id_membre']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } 
    $database = new Database();
    $db = $database->getConnection();
    

    // Vérifie que l'ID du membre 
    if ($Id_membre) {
        // Créer un nouvel objet Evenement avec les données
        $evenement = new Evenement($db, $nom, $prenom, $email, $mdp, $tel);

        // Appeler la méthode de modification de l'événement
        $evenement->modifierEvent($id_evenement);
    } else {
        echo "Erreur : ID de l'événement manquant.";
    }
    
}
?>
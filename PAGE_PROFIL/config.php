<?php 
    $hote='localhost'; 
    $port='3306'; 
    $nom_bd='afaj';
    $identifiant='root'; 
    $mot_de_passe=''; 
    $encodage='utf8';

    try {
        // Connexion à la base de données avec PDO
        $pdo = new PDO('mysql:host=localhost;dbname=afaj', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
    
    // Traitement des données POST pour mise à jour des informations
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $date_naissance = htmlspecialchars($_POST['date_naissance']);
        $telephone = htmlspecialchars($_POST['telephone']); 
    }
    

?>
 
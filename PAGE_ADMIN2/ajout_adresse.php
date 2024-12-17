<?php
require_once '../admin_config.php';
require_once 'adresse.php';
require_once 'database.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $couleur = $_POST['couleur'] ;

    // Crée un objet Evenement sans passer de $id_Evenement
    $event = new Collecte(null, $ville, $adresse, $latitude, $longitude, $couleur);

    // Appelle la méthode pour ajouter l'événement
    if ($event->ajoutCollecte()) {
        echo "L'événement a été ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du point de collecte.";
    }
}
    
?>


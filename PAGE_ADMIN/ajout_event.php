<?php
require_once '../admin_config.php';
require_once 'evenment.php';
require_once 'database.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    // Récupère les valeurs du formulaire
    $nom = $_POST['nom'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $adresse = $_POST['adresse'];

    // Crée un objet Evenement sans passer de $id_Evenement
    $event = new Evenement(null, $nom, $dateDebut, $dateFin, $adresse);

    // Appelle la méthode pour ajouter l'événement
    if ($event->ajoutEvent()) {
        echo "L'événement a été ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout de l'événement.";
    }
}
?>

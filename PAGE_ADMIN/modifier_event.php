<?php
require_once 'admin_config.php';
require_once 'evenement.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    // Récupère les valeurs du formulaire
    $nom = $_POST['nom'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $adresse = $_POST['adresse'];
    $id_Evenement = $_POST['id_Evenement']; // Récupérer l'ID de l'événement à modifier

    // Crée une instance de la classe Evenement
    $event = new Evenement($db, $nom_evenement, $date_de_debut, $date_de_fin, $lieu);

    // Appelle la méthode pour modifier l'événement
    $event->modifierEvent($id_evenement);
}
?>

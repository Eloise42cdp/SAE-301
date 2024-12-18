<?php
require_once 'admin_config.php';
require_once 'evenement.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    // Récupère les valeurs du formulaire
    $nom_evenement = $_POST['nom_evenement'];
    $date_de_debut = $_POST['date_de_debut'];
    $date_de_fin = $_POST['date_de_fin'];
    $lieu = $_POST['lieu'];

    // Crée une instance de la classe Evenement
    $event = new Evenement($db, $nom_evenement, $date_de_debut, $date_de_fin, $lieu);

    // Appelle la méthode pour ajouter l'événement
    $event->ajoutEvent();
}
?>
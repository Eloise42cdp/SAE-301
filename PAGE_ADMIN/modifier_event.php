<?php
require_once '../admin_config.php';
require_once 'evenment.php';


// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_evenement = $_POST['id_evenement'];

    // Récupère les valeurs du formulaire
    $nom = $_POST['nom'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $adresse = $_POST['adresse'];
    $id_Evenement = $_POST['id_Evenement']; // Récupérer l'ID de l'événement à modifier

    // Créer un nouvel objet Evenement avec les données
    $evenement = new Evenement($db, $nom, $dateDebut, $dateFin, $adresse);

    // Appeler la méthode de modification de l'événement
    $evenement->modifierEvent($id_evenement);
}
?>

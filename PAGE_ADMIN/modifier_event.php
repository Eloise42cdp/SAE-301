<?php
require_once '../admin_config.php';
require_once 'database.php';
require_once 'evenment.php';

// Initialiser la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les valeurs du formulaire avec vérification des clés
    $id_evenement = $_POST['id_evenement'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $dateDebut = $_POST['dateDebut'] ?? null;
    $dateFin = $_POST['dateFin'] ?? null;
    $adresse = $_POST['adresse'] ?? null;

    // Vérifie que l'ID de l'événement est présent
    if ($id_evenement) {
        // Créer un nouvel objet Evenement avec les données
        $evenement = new Evenement($db, $nom, $dateDebut, $dateFin, $adresse);

        // Appeler la méthode de modification de l'événement
        $evenement->modifierEvent($id_evenement);
    } else {
        echo "Erreur : ID de l'événement manquant.";
    }
}
?>

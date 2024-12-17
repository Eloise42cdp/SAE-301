<?php
require_once '../admin_config.php';
require_once 'adresse.php';
require_once 'database.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresse = $_POST['adresse'] ?? null; 

    $database = new Database();
    $db = $database->getConnection();

    // Préparez la requête pour supprimer l'événement
    $sql = "DELETE FROM collecte WHERE adresse = :adresse";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':adresse', $adresse);

    if ($stmt->execute()) {
        echo "L'événement a été supprimé avec succès.";
    } 
}

?>

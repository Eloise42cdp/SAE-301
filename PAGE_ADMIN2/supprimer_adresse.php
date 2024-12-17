<?php
require_once '../admin_config.php';
require_once 'adresse.php';
require_once 'database.php';

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresse = $_POST['adresse'] ?? null; 

    if ($adresse === null) {
        echo "L'adresse est requise.";
        exit;
    }

    try {
        $database = new Database();
        $db = $database->getConnection();

        // Préparez la requête pour supprimer l'événement
        $sql = "DELETE FROM collecte WHERE adresse = :adresse";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':adresse', $adresse);

        // Exécution de la requête
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Le point de collecte a été supprimé avec succès.";
            } else {
                echo "Aucun point de collecte trouvé pour l'adresse spécifiée.";
            }
        } else {
            echo "Erreur lors de la suppression du point de collecte.";
        }
    } catch (PDOException $e) {
        echo "Erreur de base de données : " . $e->getMessage();
    }
}
?>

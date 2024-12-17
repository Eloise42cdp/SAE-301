<?php
// Inclure la classe Database pour la connexion à la BDD
require_once 'admin_config.php';

// Créer une instance de la classe Database
$database = new Database();
$db = $database->getConnection();

// Vérifier si la connexion à la base de données a réussi
if ($db === null) {
    echo json_encode(["error" => "Impossible de se connecter à la base de données."]);
    exit();
}

// Préparer la requête pour récupérer les adresses
$sql = "SELECT latitude, longitude, description FROM collecte"; // Remplace 'collecte' par le nom de ta table
$stmt = $db->prepare($sql);
$stmt->execute();

// Récupérer les résultats
$adresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si des résultats ont été trouvés
if (count($adresses) > 0) {
    // Retourner les résultats sous forme de JSON
    echo json_encode($adresses);
} else {
    // Aucun résultat trouvé
    echo json_encode(["error" => "Aucune adresse trouvée."]);
}

// Fermer la connexion
$db = null;
?>


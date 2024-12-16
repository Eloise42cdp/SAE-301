<?php
require_once '../admin_config.php';

header('Content-Type: application/json');

// Créer une instance de la connexion à la base de données
$database = new Database();
$pdo = $database->getConnection();

try {
    $stmt = $pdo->query('SELECT Id_collecte, latitude, longitude, description FROM collecte');
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($addresses);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>

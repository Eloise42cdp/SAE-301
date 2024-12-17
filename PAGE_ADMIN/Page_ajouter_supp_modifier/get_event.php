<?php
require_once 'admin_config.php';
$database = new Database();
$db = $database->getConnection();

// Récupérer la liste des événements
$sql = "SELECT id_Evenement, nom FROM evenement";
$stmt = $db->prepare($sql);
$stmt->execute();
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

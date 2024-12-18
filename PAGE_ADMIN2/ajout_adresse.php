<?php
require_once '../admin_config.php';
require_once 'adresse.php';
require_once 'database.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["error" => "Impossible de se connecter à la base de données."]);
    exit();
}
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $couleur = $_POST['couleur'] ;

    

    try {
        $stmt = $db->prepare("INSERT INTO collecte (ville, adresse, latitude, longitude, couleur) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ville, $adresse, $latitude, $longitude, $couleur]);

        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
    }
}

$conn = null;
    
?>


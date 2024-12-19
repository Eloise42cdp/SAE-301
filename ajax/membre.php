<?php
header('Content-Type: application/json'); // On renvoie du JSON
include_once "../class/bdd.php";
include_once "../class/user.php";
//include_once "class/evenement.php";

$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="admin" ) {
    header("Location: connexion.php");
    exit;
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action === 'del_membre') {
    // On récupère les données transmises en POST
    $idMembre = $_POST['membre-sup'] ?? null;  // ou 0 par défaut
    $idMembre = (int)$idMembre; // Sécurisation (cast int)

    if ($idMembre <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID membre invalide ou non fourni.'.$idMembre]);
        exit;
    }

    // Exécuter la requête de suppression du membre
    $sql = "DELETE FROM membre WHERE Id_membre  = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $idMembre, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Supprime les Droit du membre dans la table MembreDroit
        $sql = "DELETE FROM membredroit WHERE Id_Membre  = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $idMembre, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Membre supprimé avec succès.']);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'La suppression a échoué.']);
    }
    exit;

} else {
    // Action inconnue ou non spécifiée
    echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
    exit;
}


?>
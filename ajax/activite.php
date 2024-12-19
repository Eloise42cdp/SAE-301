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

if ($action === 'ajouter_activite') {
    // On récupère les données transmises en POST
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';

    if (empty($nom)) {
        echo json_encode(['success' => false, 'message' => 'Il n\'y a pas d\'activitée à ajouter.']);
        exit;
    }

    // Préparer la requête pour ajouter l'activité
    $query='INSERT INTO jouertype (nom) VALUES (:nom)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Activité est bien ajouté.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Échec de l\'ajout.']);
    }
    exit;
} elseif ($action === 'del_activite') {
    // On récupère les données transmises en POST
    $idActivite = $_POST['activite-sup'] ?? null;  // ou 0 par défaut
    $idActivite = (int)$idActivite; // Sécurisation (cast int)

    if ($idActivite <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID activité invalide ou non fourni.'.$idActivite]);
        exit;
    }

    // Exécuter la requête de suppression du membre
    $sql = "DELETE FROM jouertype WHERE Id_JouerType = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $idActivite, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Supprime les Droit du membre dans la table MembreDroit
        $sql = "DELETE FROM membredroit WHERE Id_JouerType  = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $idActivite, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            // Supprime les evenement type dans la table MembreDroit
            $sql = "DELETE FROM evenementtype WHERE Id_JouerType  = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $idActivite, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Activité supprimé avec succès.']);
            }
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
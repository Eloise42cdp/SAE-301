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

if ($action === 'get_event') {
    // Récupérer un événement via son ID
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID invalide.']);
        exit;
    }

    $sql = "SELECT id_Evenement, nom, DateDebut, DateFin, Adresse
            FROM evenement
            WHERE id_Evenement = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $evenement = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($evenement) {
        echo json_encode(['success' => true, 'evenement' => $evenement]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Aucun événement trouvé pour cet ID.']);
    }
    exit;

} 

elseif ($action === 'update_event') {
    // Mettre à jour l’événement
    // On récupère les données transmises en POST
    $id         = isset($_POST['id_evenement']) ? (int)$_POST['id_evenement'] : 0;
    $nom        = isset($_POST['nom'])          ? trim($_POST['nom'])         : '';
    $dateDebut  = isset($_POST['dateDebut'])    ? trim($_POST['dateDebut'])   : '';
    $dateFin    = isset($_POST['dateFin'])      ? trim($_POST['dateFin'])     : '';
    $adresse    = isset($_POST['adresse'])      ? trim($_POST['adresse'])     : '';

    if ($id <= 0 || empty($nom) || empty($dateDebut) || empty($dateFin) || empty($adresse)) {
        echo json_encode(['success' => false, 'message' => 'Champs manquants ou ID invalide.']);
        exit;
    }

    // Préparer la requête de mise à jour
    $sql = "UPDATE evenement
            SET nom = :nom,
                dateDebut = :dateDeb,
                dateFin = :dateFin,
                adresse = :adresse
            WHERE id_Evenement = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':nom',     $nom,      PDO::PARAM_STR);
    $stmt->bindValue(':dateDeb', $dateDebut, PDO::PARAM_STR);
    $stmt->bindValue(':dateFin', $dateFin,   PDO::PARAM_STR);
    $stmt->bindValue(':adresse', $adresse,   PDO::PARAM_STR);
    $stmt->bindValue(':id',      $id,        PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Événement mis à jour.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Échec de la mise à jour.']);
    }
    exit;

} elseif ($action === 'del_event') {
    // On récupère les données transmises en POST
    $idEvenement = $_POST['evenement-sup'] ?? null;  // ou 0 par défaut
    $idEvenement = (int)$idEvenement; // Sécurisation (cast int)

    if ($idEvenement <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID événement invalide ou non fourni.']);
        exit;
    }

    // Exécuter la requête de suppression
    $sql = "DELETE FROM evenement WHERE id_Evenement = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $idEvenement, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Événement supprimé avec succès.']);
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
<?php
header('Content-Type: application/json'); // On renvoie du JSON
include_once "../class/bdd.php";
include_once "../class/user.php";

$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="membre" ) {
    header("Location: connexion.php");
    exit;
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if (isset($_GET['action']) && $_GET['action'] === 'load_profil') {

    // Charger les informations de l'utilisateur
    // Récupérer les informations du membre
    $query = $db->prepare("SELECT prenom, nom, email, datenaissance, tel FROM membre WHERE Id_Membre = :idMembre");
    $query->bindParam(':idMembre', $user->IdUser, PDO::PARAM_INT);
    $query->execute();
    $profil = $query->fetch(PDO::FETCH_ASSOC);

    if (!$profil) {
        echo json_encode(['success' => false, 'message' => 'Membre non trouvé.']);
        exit;
    }

    // Récupérer les droits (JouerType) du membre
    $query = $db->prepare("
        SELECT jt.Id_JouerType, jt.nom, (md.Id_Membre IS NOT NULL) AS checked
        FROM jouertype jt
        LEFT JOIN membredroit md ON jt.Id_JouerType = md.Id_JouerType AND md.Id_Membre = :idMembre
    ");
    $query->bindParam(':idMembre', $user->IdUser, PDO::PARAM_INT);
    $query->execute();
    $jouerOptions = $query->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter les droits aux données du profil
    $profil['jouerOptions'] = $jouerOptions;

    // Envoyer les données au client
    echo json_encode(['success' => true, 'data' => $profil]);


    
} elseif ($action === 'update_profil') {
    // On récupère les données transmises en POST
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $datenaissance = isset($_POST['datenaissance']) ? trim($_POST['datenaissance']) : '';
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
    $jouerOptions = isset($_POST['JouerType']) ? $_POST['JouerType'] : [];

    // Vérifier que les champs obligatoires sont remplis
    if (empty($prenom) || empty($nom) || empty($email) || empty($datenaissance)) {
        echo json_encode(['success' => false, 'message' => 'Il manque des informations obligatoires.']);
        exit;
    }

    // Exemple de connexion à la base de données
    try {
        // Début de transaction
        $db->beginTransaction();

        // Mettre à jour les informations principales
        $query = "UPDATE membre SET prenom = :prenom, nom = :nom, email = :email, dateNaissance = :dateNaissance, tel = :tel WHERE Id_membre  = :id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':dateNaissance' => $datenaissance,
            ':tel' => $tel,
            ':id' => $user->IdUser, // ID du membre
        ]);

        // Mettre à jour les options JouerType
        // Supprimer les anciennes valeurs
        $deleteQuery = "DELETE FROM membredroit WHERE Id_Membre = :id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->execute([':id' => $user->IdUser]);

        // Supprime tous les valeur du membre pour les droits
        $deleteQuery = "DELETE FROM membredroit WHERE Id_Membre = :id";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->execute([':id' => $user->IdUser]);

        // Ajouter les nouvelles valeurs
        if (!empty($jouerOptions)) {
            $insertQuery = "INSERT INTO membredroit (Id_Membre, Id_JouerType) VALUES (:utilisateur_id, :Id_JouerType)";
            $insertStmt = $db->prepare($insertQuery);

            foreach ($jouerOptions as $jouerTypeId) {
                if ($jouerTypeId > 0) { // Éviter les valeurs invalides
                    $insertStmt->execute([
                        ':utilisateur_id' => $user->IdUser,
                        ':Id_JouerType' => $jouerTypeId,
                    ]);
                }
            }

/*            
            $insertQuery = "INSERT INTO membredroit (Id_Membre, Id_JouerType) VALUES (:utilisateur_id, :Id_JouerType)";
            $insertStmt = $db->prepare($insertQuery);

            foreach ($jouerOptions as $jouerTypeId) {
                $insertStmt->execute([
                    ':utilisateur_id' => $user->IdUser,
                    ':Id_JouerType' => $jouerTypeId,
                ]);
            }
*/
        }

        // Valider la transaction
        $db->commit();

        echo json_encode(['success' => true, 'message' => 'Profil mis à jour avec succès.']);
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()]);
    }



}else {
    // Action inconnue ou non spécifiée
    echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
    exit;
}




?>
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










<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectEvent = document.getElementById('evenement');
        const form = document.getElementById('form_modifier_event');

        const inputId       = document.getElementById('id_evenement');
        const inputNom      = document.getElementById('nom');
        const inputDateDeb  = document.getElementById('dateDebut');
        const inputDateFin  = document.getElementById('dateFin');
        const inputAdresse  = document.getElementById('adresse');
        const messageDiv    = document.getElementById('message');

        // Appel AJAX pour charger les infos
        selectEvent.addEventListener('change', function() {
            fetch(`../ajax/modif_evenement.php?action=get_event&id=${this.value}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        inputId.value      = data.evenement.id_Evenement;
                        inputNom.value     = data.evenement.nom;
                        inputDateDeb.value = data.evenement.DateDebut.replace(' ', 'T');
                        inputDateFin.value = data.evenement.DateFin.replace(' ', 'T');
                        inputAdresse.value = data.evenement.Adresse;
                    } else {
                        messageDiv.innerHTML = '<p style="color:red;">' + data.message + '</p>';
                    }
                });
        });

        // Appel AJAX pour modifier
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            formData.append('action', 'update_event');

            fetch('../ajax/modif_evenement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = '<p style="color:green;">Événement modifié !</p>';
                } else {
                    messageDiv.innerHTML = '<p style="color:red;">' + data.message + '</p>';
                }
            });
        });
    });
</script>

<body>
<h2>Modifier un événement</h2>
<div id="message"></div>
<form id="form_modifier_event">
    <label for="evenement">Sélectionner un événement :</label><br>
    <select id="evenement" name="id_evenement">
        <option value="">-- Choisir un événement --</option>
        <?php
        include '../class/bdd.php'; // Connexion
        $stmt = $pdo->query("SELECT id_Evenement, nom FROM evenement");
        foreach ($stmt->fetchAll() as $event) {
            echo '<option value="'.$event['id_Evenement'].'">'.$event['nom'].'</option>';
        }
        ?>
    </select><br><br>

    <label for="nom">Nom événement :</label><br>
    <input type="text" id="nom" name="nom"><br><br>

    <label for="dateDebut">Date début :</label><br>
    <input type="datetime-local" id="dateDebut" name="dateDebut"><br><br>

    <label for="dateFin">Date fin :</label><br>
    <input type="datetime-local" id="dateFin" name="dateFin"><br><br>

    <label for="adresse">Lieu :</label><br>
    <input type="text" id="adresse" name="adresse"><br><br>

    <input type="hidden" id="id_evenement" name="id_evenement">
    <button type="submit">Modifier</button>
</form>


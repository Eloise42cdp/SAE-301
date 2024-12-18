<?php
session_start();
include_once "config.php"; // Configuration de la base de données
include_once "../header_membre.php"; // En-tête du site

// Vérification de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: profil_membre.php');
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=afaj', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// Récupération des informations actuelles de l'utilisateur
$stmt = $pdo->prepare('SELECT nom, prenom, email, dateNaissance, tel FROM membre WHERE Id_membre = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    die('Utilisateur non trouvé.');
}

// Traitement de la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $dateNaissance = $_POST['datenaissance'];
    $tel = htmlspecialchars(trim($_POST['tel']));

    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($dateNaissance) || empty($tel)) {
        $error = "Tous les champs doivent être remplis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'email n'est pas valide.";
    } else {
        // Mise à jour des informations
        $stmt = $pdo->prepare('UPDATE membre SET nom = ?, prenom = ?, email = ?, dateNaissance = ?, tel = ? WHERE Id_membre = ?');
        $stmt->execute([$nom, $prenom, $email, $dateNaissance, $tel, $_SESSION['user_id']]);

        // Redirection avec message de succès
        header('Location: profile.php?update=success');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css?v=1.0" rel="stylesheet">
</head>

<body>
    <!-- Page de modification du profil -->
    <section class="connexion">
        <div class="col">
            <div class="titre">
                <h1>Informations sur votre profil</h1>
                <div class="champs">
                    <!-- Affichage des erreurs -->
                    <?php if (isset($error)) : ?>
                        <p style="color: red;"><?= $error ?></p>
                    <?php endif; ?>

                    <!-- Formulaire -->
                    <form method="post">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                        <br>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                        <br>
                        <label for="datenaissance">Date de naissance :</label>
                        <input type="date" id="datenaissance" name="datenaissance" value="<?= htmlspecialchars($user['dateNaissance']) ?>" required>
                        <br>
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                        <br>
                        <label for="tel">Téléphone :</label>
                        <input type="tel" id="tel" name="tel" value="<?= htmlspecialchars($user['tel']) ?>" maxlength="20" required>
                        <br><br>
                        <div class="checkbox">
                            <h6>Je participe :</h6>
                            <label>
                                <input type="checkbox" id="select-all"> Aux collectes des jouets
                            </label>
                            <label>
                                <input type="checkbox" id="deselect-all"> Ne sais pas
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php
include_once "../footer.php"; // Pied de page
?>

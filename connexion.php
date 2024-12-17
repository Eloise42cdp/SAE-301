<?php
include_once "header.php";
//if (!isset($_SESSION)) session_start();
include_once "class/bdd.php";
include_once "class/user.php";

// Cree un mot de passe
//$MDP = password_hash("1234", PASSWORD_DEFAULT);
//echo "<br>MDP : ".$MDP;
$db = new Database();
$bdd=$db->getConnection();
$user = new User($bdd);

// Si il y a une session ouverte, on vas dans admin
if ($user->isLoggedIn()) {
    header("Location: admin.php");
    exit;
}

// Login Membre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action']=="login") {
    $email = $_POST['loginemail'];
    $password = $_POST['loginpassword'];

    if ($user->login($email, $password)) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Le mail ou le mot de passe est invalide.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action']=="creation") {
    $prenom = htmlspecialchars(strip_tags($_POST['prenom']));
    $nom = htmlspecialchars(strip_tags($_POST['nom']));
    $datenaissance = htmlspecialchars(strip_tags($_POST['datenaissance']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $mdp = htmlspecialchars(strip_tags($_POST['password']));
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $tel = htmlspecialchars(strip_tags($_POST['tel']));
    $JouerType=$_POST['JouerType'];

    if (!empty($prenom) && 
    !empty($nom) && 
    !empty($datenaissance) &&
    !empty($email) &&
    !empty($mdp) &&
    !empty($tel)
    ) {
        $query = "INSERT INTO membre (prenom, nom, dateNaissance, email, mdp, tel) VALUES (:prenom, :nom, :dateNaissance, :email, :mdp, :tel)";
        
        //$db = new Database();
        //$bdd=$db->getConnection();
        $stmt = $bdd->prepare($query);

        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':dateNaissance', $datenaissance);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':tel', $tel);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Compte créé avec succès.</p>";

            // On ajoute droit membre
            // Récupérer le dernier ID du membre cree
            $Id_Membre = $bdd->lastInsertId();

            foreach ($JouerType as $value) {
                $query = "INSERT INTO membredroit (Id_Membre, Id_JouerType) VALUES (:Id_Membre, :Id_JouerType)";
                //$db = new Database();
                //$bdd=$db->getConnection();
                $stmt = $bdd->prepare($query);
                $stmt->bindParam(':Id_Membre', $Id_Membre);
                $stmt->bindParam(':Id_JouerType', $value);
                $stmt->execute();
            }
        } else {
            echo "<p style='color: red;'>Erreur lors de la création du compte.</p>";
        }
    } else {
        echo "<p style='color: red;'>Tous les champs sont requis.</p>";
    }
}




?>

<!-- Login Page -->
<div class="ConnexionLogin">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">email:</label>
        <input type="text" id="loginemail" name="loginemail" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="loginpassword" name="loginpassword" required>
        <br>
        <input type="hidden" name="action" value="login">
        <button type="submit">Login</button>
    </form>
</div>

<div class="ConnexionCreeCompte">
    <h1>Créer un compte</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br>
        <label for="email">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="date">Date de naissance :</label>
        <input type="date" id="datenaissance" name="datenaissance" required>
        <div id="extra-fields">
            <br>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email">
            <br>
            <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password">
            <br>
            <label for="phone">Téléphone :</label>
                <input type="tel" id="tel" name="tel" maxlength="20">
            <br>
            <label>
                <input type="checkbox" id="select-all"> aux collectes des jouets
            </label>
            <label>
                <input type="checkbox" id="deselect-all"> ne sais pas
            </label>
            <br>
<?php

$db = new Database();
$bdd=$db->getConnection();
$query = "SELECT * FROM jouertype ORDER BY nom";
$resultats_JouerOption=$bdd->query($query);
$tab_JouerOption = $resultats_JouerOption->fetchAll(PDO::FETCH_ASSOC);


foreach ($tab_JouerOption as $value) {
    echo "<label>";
    echo '<input type="checkbox" class="options" name="JouerType[]" value="'.$value['Id_JouerType'].'">'.$value['nom'];
    echo "</label>";
}


?>
            <input type="hidden" name="action" value="creation">
            <button type="submit">Créer mon compte</button>
        </div>
    </form>

</div>
<?php
include_once "footer.php";
?>
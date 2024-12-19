<?php
include_once "header.php";
//if (!isset($_SESSION)) session_start();
include_once "class/bddm.php";
include_once "class/user.php";

// Cree un mot de passe
//$MDP = password_hash("1234", PASSWORD_DEFAULT);
//echo "<br>MDP : ".$MDP;
$db = new Database();
$bdd = $db->getConnection();
$user = new User($bdd);

// Si il y a une session ouverte, on vas dans admin
if ($user->isLoggedIn()) {
    header("Location: admin.php");
    exit;
}

// Login Membre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "login") {
    $email = $_POST['loginemail'];
    $password = $_POST['loginpassword'];

    if ($user->login($email, $password)) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Le mail ou le mot de passe est invalide.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "creation") {
    $prenom = htmlspecialchars(strip_tags($_POST['prenom']));
    $nom = htmlspecialchars(strip_tags($_POST['nom']));
    $datenaissance = htmlspecialchars(strip_tags($_POST['datenaissance']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $mdp = htmlspecialchars(strip_tags($_POST['password']));
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $tel = htmlspecialchars(strip_tags($_POST['tel']));
    $JouerType = $_POST['JouerType'];

    if (
        !empty($prenom) &&
        !empty($nom) &&
        !empty($datenaissance) &&
        !empty($email) &&
        !empty($mdp) &&
        !empty($tel)
    ) {

        // Verifi si le compte avec l'email existe ou pas
        $query = "SELECT email FROM membre WHERE email=:email";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                // il y a deja un email
                echo "<p style='color: red;'>Err: il y a déjà un compte avec cette email :".$email."</p>";
            }else{
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
            }
    
        }
    } else {
        echo "<p style='color: red;'>Tous les champs sont requis.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="css/style.css?v=1.0" rel="stylesheet">

</head>

<body>
    <!-- Login Page -->
    <section class="connexion">
        <div class="col">
            <div class="titre">
                <h1>Connectez-vous à votre compte AFAJ</h1>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </div>
            <div class="champsConnexion">
                <form method="post" action="">
                    <label for="email">Email:</label>
                    <input type="text" id="loginemail" name="loginemail" required>
                    <br>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="loginpassword" name="loginpassword" required>
                    <br>
                    <input type="hidden" name="action" value="login">
                    <button class="btn1" type="submit">Se connecter</button>
                </form>
                <img src="img/banderolee.png" class="img-fluid" alt="Banderole">
            </div>
        </div>

        <div class="col">
            <div class="titre">
                <h1>Créez votre compte AFAJ et devenez membre</h1>
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <div class="champsConnexion">
                    <form method="post" action="">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                        <br>
                        <label for="email">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                        <br>
                        <label for="date">Date de naissance :</label>
                        <input type="date" id="datenaissance" name="datenaissance" required>

                        <div class="champsConnexion" id="extra-fields" style="display: none;">
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email">
                            <br>
                            <label for="password">Mot de passe :</label>
                            <input type="password" id="password" name="password">
                            <br>
                            <label for="phone">Téléphone :</label>
                            <input type="tel" id="tel" name="tel" maxlength="20">
                            <br><br>
                            <div class="checkbox">
                                <h6>Je souhaite participer :</h6>
                                <label>
                                    <input type="checkbox" id="select-all"> Aux collectes des jouets
                                </label>
                                <label>
                                    <input type="checkbox" id="deselect-all"> Ne sais pas
                                </label>
                            </div>

                            <?php

                            $db = new Database();
                            $bdd = $db->getConnection();
                            $query = "SELECT * FROM jouertype ORDER BY nom";
                            $resultats_JouerOption = $bdd->query($query);
                            $tab_JouerOption = $resultats_JouerOption->fetchAll(PDO::FETCH_ASSOC);


                            foreach ($tab_JouerOption as $value) {
                                echo "<label>";
                                echo '<input type="checkbox" class="options" name="JouerType[]" value="' . $value['Id_JouerType'] . '">' . $value['nom'];
                                echo "</label>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="action" value="creation">
                        <button class="btn1" type="submit">Créer mon compte</button>
                </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>

<?php
include_once "footer.php";
?>
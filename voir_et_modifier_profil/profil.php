<?php
include_once "../admin_config.php";

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
<a href="index.php" class="btn-retour">Retour Page Accueil</a>
    <div class="container">
    <?php if (!empty($user)): ?>
    <h1>Bonjour <?php echo htmlspecialchars($user['prenom']); ?></h1>
    <form method="post">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required><br>

        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required><br>

        <label for="dateNaissance">Date de naissance :</label>
        <input type="date" name="dateNaissance" value="<?php echo htmlspecialchars($user['dateNaissance']); ?>" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" value="<?php echo htmlspecialchars($user['mdp']); ?>"><br>

        <label for="tel">Téléphone :</label>
        <input type="tel" name="tel" maxlength="20" value="<?php echo htmlspecialchars($user['tel']); ?>"><br><br>
    </form>
    <?php else: ?>
        <p>Aucun membre trouvé.</p>
    <?php endif; ?>


        

        <!-- Partie Cocher les choix de nos participations -->

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

        <button type="submit" class="btn-valider">VALIDER et MODIFIER</button>

        
    </div>
</body>

</html>

<?php
include_once "admin_config.php";
include_once "../header_membre.php";
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
        <h1>Bonjour<?php echo htmlscpecialchars($user['prenom']); ?></h1>
        <form method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo htmlscpecialchars ($user['prenom']);?>" required><br>

            <label for="email">Nom :</label>
            <input type="text" name="nom" value="<?php echo htmlscpecialchars ($user['nom']);?>"required><br>

            <label for="date">Date de naissance :</label>
            <input type="date" name="dateNaissance" value="<?php echo htmlscpecialchars ($user['dateNaissance']);?>"required><br>

            <label for="email">Email :</label>
            <input type="email" name="email"value="<?php echo htmlscpecialchars ($user['email']);?>"><br>

            <label for="password">Mot de passe :</label>
            <input type="mdp"  name="mdp"value="<?php echo htmlscpecialchars ($user['mdp']);?>"><br>

            <label for="phone">Téléphone :</label>
            <input type="tel" name="tel" maxlength="20"value="<?php echo htmlscpecialchars ($user['tel']);?>"><br><br>

            <div class="checkbox">
                <h6>Je  souhaite participer :</h6>
                
            </div>
            <button type="submit" class="btn-valider">VALIDER</button>
        </form>
    </div>
</body>

</html>

<?php
include_once "../footer.php";
?>
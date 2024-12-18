<?php
include_once "config.php";
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
    <!-- Login Page -->
    <section class="connexion">
        <div class="col">
            <div class="titre">
                <h1>Informations sur votre profil</h1>
                <div class="champs">
                    <form method="post" action="">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required>
                        <br>
                        <label for="email">Nom :</label>
                        <input type="text" id="nom" name="nom" required>
                        <br>
                        <label for="date">Date de naissance :</label>
                        <input type="date" id="datenaissance" name="datenaissance" required>
                        <br>
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
                                <h6>Je  participe :</h6>
                                <label>
                                    <input type="checkbox" id="select-all"> Aux collectes des jouets
                                </label>
                                <label>
                                    <input type="checkbox" id="deselect-all"> Ne sais pas
                                </label>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>

<?php
include_once "../footer.php";
?>
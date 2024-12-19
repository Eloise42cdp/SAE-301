<?php
include_once "header_admin.php";
include_once "class/bddm.php";
include_once "class/user.php";
$db = (new Database())->getConnection();
$user = new User($db);

    // // Si pas de connexion ou pas le role admin, on quite l'espace membre
    // if (!$user->isLoggedIn() || $user->role!="admin" ) {
    //     header("Location: connexion.php");
    //     exit;
    // }

// Si on clic sur logout
if (isset($_GET['logout'])) {
    $user->logout();
}
//echo "<br>Espace Administrateur:".$user->role;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Contenu principal -->
    <main class="container my-5">
        <!-- Tes sections de contenu ici -->
    </main>
    <section class="containerA">
        <div class="titreA">
            <h2>Bonjour Prénom !</h2>
            <p>Dans cet espace, vous avez la possibilité de modifier les éléments de votre site.</p>
        </div>
        <div class="row justify-content-center mb-3">
            <!-- Première ligne -->
            <div class="col-6">
                <button class="btnA1"><h1>Paramètres<br>Événement</h1></button>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Deuxième ligne -->
            <div class="col-6">
                <button class="btnA3"><h1>Supprimer<br>le profil d’un membre</h1></button>
            </div>
            <div class="col-6">
                <button class="btnA4"><h1>Paramètres<br>Liste activités membres</h1></button>
            </div>
        </div>
    </section>
</body>
</html>
<?php
include_once "footer.php";
?>
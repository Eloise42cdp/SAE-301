<?php
include_once "header_admin.php";
include_once "class/bdd.php";
include_once "class/user.php";
$db = (new Database())->getConnection();
$user = new User($db);

/* Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="admin" ) {
    header("Location: connexion.php");
    exit;
}

// Si on clic sur logout
if (isset($_GET['logout'])) {
    $user->logout();
}

echo "<br>Espace Administrateur:".$user->role;*/

?>

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
            <div class="col-6">
                <button class="btnA2"><h1>Paramètres<br>Lieux de collecte</h1></button>
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
<?php
include_once "footer.php";
?>
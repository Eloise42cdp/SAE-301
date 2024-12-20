<?php
include_once "header_admin.php";
include_once "class/bdd.php";
include_once "class/user.php";
$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role != "admin") {
    header("Location: connexion.php");
    exit;
}

// Si on clic sur logout
if (isset($_GET['logout'])) {
    $user->logout();
}
?>
<section class="containerA">
    <div class="titreA">
        <div id="btnDeconnexion">
            <h2>
                <?php
                echo "<br>Bonjour " . $user->GetNameMembre() . " !";
                ?>
            </h2>
            <br>
            <p>Dans cet espace, vous avez la possibilité de modifier les éléments de votre site.</p>
            <br>
        </div>
        <div class="justify-content-center mb-3">
            <div class="col-6">
                <a class="btnC" href="admin_evenement.php" alt="Paramètres Événement">Paramètres Événement</a>
            </div>
        </div>
        <div class="justify-content-center mb-3">
            <div class="col-6">
                <a class="btnC" href="admin_membre.php" alt="Supprimer le profil d’un membre">Supprimer le profil d’un membre</a>
            </div>
        </div>
        <div class="justify-content-center mb-3">
            <div class="col-6">
                <a class="btnC" href="admin_activite.php" alt="Paramètres Liste activités membres">Paramètres Liste activités membres</a>
            </div>
        </div>
    </div><br>
</section>
<?php
include_once "footer.php";
?>
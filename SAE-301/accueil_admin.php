<?php
include_once "header_admin.php";
include_once "class/bdd.php";
include_once "class/user.php";
$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="admin" ) {
    header("Location: connexion.php");
    exit;
}

// Si on clic sur logout
if (isset($_GET['logout'])) {
    $user->logout();
}

echo "<br>Espace Administrateur:".$user->role;






?>
<br>
Dans cet espace, vous avez la possibilité de modifier les éléments de votre site.
<br>
<a href="" alt="Paramètres Événement">Paramètres Événement</a>
<br>
<a href="" alt="Paramètres Lieux de collecte">Paramètres Lieux de collecte</a>
<br>
<a href="" alt="Supprimer le profil d’un membre">Supprimer le profil d’un membre</a>
<br>
<a href="" alt="Paramètres Liste activités membres">Paramètres Liste activités membres</a>



<br>
Nos points de collecte

<br>
Informations relatives aux profils
<?php
include_once "footer.php";
?>
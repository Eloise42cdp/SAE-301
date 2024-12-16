<?php
include_once "header_membre.php";
include_once "class/bdd.php";
include_once "class/user.php";
$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role membre, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="membre") {
    header("Location: connexion.php");
    exit;
}

echo "<br>Espace Membre:".$user->role;


?>


<br>
Nos points de collecte

<br>
Informations relatives aux profils



<?php
include_once "footer.php";
?>
<?php
include_once "class/bddm.php";
include_once "class/user.php";

$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
// if (!$user->isLoggedIn() || $user->role!="admin" ) {
//     header("Location: connexion.php");
//     exit;
// }


include_once "header_admin.php";
include_once "templates/membre.php";
include_once "footer.php";

?>
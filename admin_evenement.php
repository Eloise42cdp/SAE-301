<?php
include_once "class/bdd.php";
include_once "class/user.php";
include_once "class/evenement.php";

$db = (new Database())->getConnection();
$user = new User($db);

// Si pas de connexion ou pas le role admin, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role!="admin" ) {
    header("Location: connexion.php");
    exit;
}


// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action']=="ajout_evenement") {
    //$database = new Database();
    //$db = $database->getConnection();

    // Récupère les valeurs du formulaire
    $nom_evenement = $_POST['nom_evenement'];
    $date_de_debut = $_POST['date_de_debut'];
    $date_de_fin = $_POST['date_de_fin'];
    $lieu = $_POST['lieu'];
    //$JouerType=$_POST['JouerType'];
    $JouerType = isset($_POST['JouerType']) ? $_POST['JouerType'] : [];

    // Crée une instance de la classe Evenement
    $event = new Evenement($db, $nom_evenement, $date_de_debut, $date_de_fin, $lieu, $JouerType);

    // Appelle la méthode pour ajouter l'événement
    $event->ajoutEvent();
}

include_once "header_admin.php";
include_once "templates/evenement/evenement.php";
include_once "footer.php";

?>
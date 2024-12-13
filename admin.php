<?php
if (!isset($_SESSION)) session_start();
include_once "class/bdd.php";
include_once "class/user.php";

//var_dump($_SESSION); // Pour voir ce qui est défini dans la session

// Gestion de l'admin
$db = (new Database())->getConnection();
$user = new User($db);

if (!$user->isLoggedIn()) {
    header("Location: connexion.php");
    exit;
}

if (isset($_GET['logout'])) {
    $user->logout();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice</title>
</head>
<body>
    <h1>Bonjour, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <a href="?logout">Déconnexion</a>
</body>
</html>

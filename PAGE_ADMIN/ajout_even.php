<?php
require 'admin.php';

$event = new Event('localhost', 'nom_de_la_bdd', 'root', 'mot_de_passe');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $date = $_POST['date'];
  $lieu = $_POST['lieu'];
  $description = $_POST['description'];

  $event->addEvent($nom, $date, $lieu, $description);
  header('Location: admin.html');
}
?>

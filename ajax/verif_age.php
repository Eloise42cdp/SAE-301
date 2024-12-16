<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateNaissance = $_POST['dateNaissance'];
    $birthDate = new DateTime($dateNaissance);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    echo ($age >= 18) ? "show" : "hide";
}
?>
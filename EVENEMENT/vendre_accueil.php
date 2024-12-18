<?php
include 'db.php';

// Récupérer les événements depuis la BDD
$query = $pdo->query("SELECT * FROM evenement ORDER BY dateDebut ASC");
$evenements = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Événements</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Les Événements</h1>
    <?php foreach ($evenements as $event): ?>
        <div>
            
            <p><strong>Date :</strong> 

            <?= date("d/m/Y H:i", strtotime($event['dateDebut'])); ?> au 
            <?= date("d/m/Y H:i", strtotime($event['dateFin'])); ?>
            </p>
            <h2><strong>Prochaine Foire aux Jouets 2025</h2></strong>
            
            <p><strong>Lieux :</strong> <?= htmlspecialchars($event['adresse']); ?></p>
            <p><strong>Nom :</strong> <?= htmlspecialchars($event['nom']); ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
</body>
</html>

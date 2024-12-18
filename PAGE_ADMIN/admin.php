<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bases HTML et CSS Responsive">

    <title>Ajouter un événement</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <?php
    include 'get_event.php';
    ?>

</head>

<body>
    <header>
        <div class="custom-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-2">
                        <a href="Accueil.html"><img src="../img/logo.png" alt="Logo" class="header-logo"></a>
                    </div>
                    <div class="col-8 text-center">
                        <h1 class="header-title">Espace Administrateur</h1>
                        <p class="header-subtitle">Amis de la Foire Aux Jouets</p>
                    </div>
                    <div class="col-2 text-right">
                        <a href="#">
                            <button class="btn">
                                <span class="btn-text">CONNEXION</span>
                                <span class="btn-icon">
                                    <img src="IMAGE/user.png" alt="DECONNEXION" class="btn-img">
                                </span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="block">
    <h2>Ajouter un événement</h2>
    <div class="champs">
    <form method="POST" action="ajout_event.php">
        <label for="nom">Nom événement :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
    
        <label for="dateDebut">Date et heure de début :</label><br>
        <input type="datetime-local" id="dateDebut" name="dateDebut" required><br><br>
    
        <label for="dateFin">Date et heure de fin :</label><br>
        <input type="datetime-local" id="dateFin" name="dateFin" required><br><br>
    
        <label for="adresse">Lieu :</label><br>
        <input type="text" id="adresse" name="adresse" required><br><br>
    
        <button class="btnB" type="submit">AJOUTER</button><br><br>
    </form>
    </div>
    </section>
   
    <section class="block">
    <!-- Formulaire de modification -->
    <h2>Modifier un événement</h2>
    <div class="champs">
    <form method="POST" action="modifier_event.php">
        <label for="evenement">Sélectionner un événement :</label><br>
        <select name="id_evenement" id="evenement" required>
            <?php foreach ($evenements as $evenement): ?>
                <option value="<?= $evenement['id_Evenement']; ?>"><?= htmlspecialchars($evenement['nom']); ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="nom">Nom événement :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="dateDebut">Date et heure de début :</label><br>
        <input type="datetime-local" id="dateDebut" name="dateDebut" required><br><br>
        <label for="dateFin">Date et heure de fin :</label><br>
        <input type="datetime-local" id="date_de_fin" name="dateFin" required><br><br>
        <label for="adresse">Lieu :</label><br>
        <input type="text" id="adresse" name="adresse" required><br><br>
        <button class="btnB" type="submit">MODIFIER</button><br><br>
    </form>
    </div>
    </section>

    <section class="block">
    <!-- Formulaire de suppression -->
    <h2>Supprimer un événement</h2>
    <div class="champs">
    <form method="POST" action="supprimer_event.php">
        <label for="nom">Nom de l'événement :</label><br>
        <select name="nom" id="nom" required>
            <?php foreach ($evenements as $evenement): ?>
                <option value="<?= htmlspecialchars($evenement['nom']); ?>"><?= htmlspecialchars($evenement['nom']); ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <button class="btnB" type="submit">SUPPRIMER</button><br><br>
    </form>
    </div>
    </section>           

    <footer>
        <div class="custom-footer">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-2">
                        <img src="../img/logo.png" alt="Logo" class="footer-logo">
                    </div>
                    <div class="col-8 text-center">
                        <p class="footer-title">Amis de la Foire Aux Jouets</p>
                        <p class="footer-legal">AFAJ / Tous droits réservés / Mentions légales</p>
                    </div>
                    <div class="col-2 text-right">
                        <a href="Contact.html">
                            <button class="btn">
                                <span class="btn-text">CONTACT</span>
                                <span class="btn-icon">
                                    <img src="../img/user.png" alt="Contact" class="btn-img">
                                </span>
                            </button>
                        </a>
                        <a href="#" class="social-link">
                            <img src="../img/facebook.png" alt="Facebook" class="social-icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>
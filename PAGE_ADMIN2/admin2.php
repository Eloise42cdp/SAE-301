<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Espace administrateur pour gérer les événements de la Foire aux Jouets et visualiser les points de collecte sur une carte interactive.">

    <title>Administration - Amis de la Foire Aux Jouets</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admin_2.css">

    <?php //include 'get_adresses.php';?>

</head>

<body>
    <header>
        <div class="custom-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-2">
                        <a href="Accueil.html"><img src="IMAGE/logo.png" alt="Logo" class="header-logo"></a>
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

    <div class="container my-5">

        <!-- Titre principal -->
        <h1 class="text-center mb-4">Paramètres des lieux de collecte : </h1>

        <div class="row align-items-center">
            <!-- Colonne pour le texte (à gauche) -->
            <div class="col-md-5 d-flex flex-column align-items-center">
                <div class="text-left">

                </div>
            </div>

            <!-- Colonne pour la carte (à droite) -->
            <div class="col-md-7">
            <div id="map"></div>

            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            <script>
            // Ton code JavaScript ici
            // Fonction pour charger les adresses depuis la BDD
            function loadAddresses() {
                fetch('get_adresses.php')  // Appel à ton fichier PHP
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error(data.error);
                        } else {
                            // Ajouter les marqueurs à la carte pour chaque adresse
                            data.forEach(adresse => {
                                L.marker([adresse.latitude, adresse.longitude])
                                    .addTo(map)
                                    .bindPopup(adresse.description);
                            });
                        }
                    })
                    .catch(error => console.error('Erreur de chargement des adresses:', error));
            }

            // Charger les adresses depuis la BDD au chargement de la page
            loadAddresses();
            </script>

            </div>
        </div>


        <!-- Intégration de Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="admin_2.js"></script>

        <h2>Ajouter une adresse</h2>
            <form id="addAddressForm" method="POST" action="ajout_adresse.php">
                <label for="ville">Ville</label><br>
                <input type="text" id="ville" name="ville" required><br><br>

                <label for="adresse">Adresse</label><br>
                <input type="text" id="adresse" name="adresse" required><br><br>

                <label for="longitude">Longitude</label><br>
                <input type="text" id="longitude" name="longitude" required><br><br>

                <label for="latitude">Latitude</label><br>
                <input type="text" id="latitude" name="latitude" required><br><br>

                <label for="couleur">Couleur</label><br>
                <input type="text" id="couleur" name="couleur" required><br><br>

                <button type="submit">AJOUTER</button><br><br>
            </form>


            

        <!-- Formulaire de suppression -->
        <h2>Supprimer une adresse </h2>
        <form method="POST" action="supprimer_adresse.php">
            <label for="adresse">Adresse</label><br>
            <select name="adresse" id="adresse" required>
                <?php foreach ($collecte as $collecte): ?>
                <option value="<?= htmlspecialchars($collecte['adresse']); ?>">
                    <?= htmlspecialchars($collecte['adresse']); ?>
                </option>
                <?php endforeach; ?>
            </select><br><br>
            <button type="submit">SUPPRIMER</button><br><br>
        </form>



    </div>

    <footer>
        <div class="custom-footer">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-2">
                        <img src="IMAGE/logo.png" alt="Logo" class="footer-logo">
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
                                    <img src="IMAGE/user.png" alt="Contact" class="btn-img">
                                </span>
                            </button>
                        </a>
                        <a href="#" class="social-link">
                            <img src="IMAGE/facebook.png" alt="Facebook" class="social-icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


</body>

</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">

    <!-- Login et Creation de compte -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src= "creercompte.js"></script>
    
    <style>
        #extra-fields {
           display: none;
        }
    </style>
</head>
<body>
<!-- Réalisation du Header -->
<header>
    <div class="custom-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-2">
                    <a href="index.php"><img src="img/logo.png" alt="Logo" class="header-logo"></a>
                </div>
                <div class="col-8 text-center">
                    <h1 class="header-title">Espace Membre</h1>
                    <p class="header-subtitle">Amis de la Foire Aux Jouets</p>
                </div>
                <div class="col-2 text-right">
                    <a href="admin.php?logout">
                        <button class="btn">
                            <span class="btn-text">DÉCONNEXION</span>
                            <span class="btn-icon">
                                <img src="img/user.png" alt="Connexion" class="btn-img">
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
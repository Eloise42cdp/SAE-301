
<?php
if (!isset($_SESSION)) session_start();
include_once "class/bdd.php";
include_once "class/user.php";

// Cree un mot de passe
//$MDP = password_hash("1234", PASSWORD_DEFAULT);
//echo "<br>MDP : ".$MDP;


// Login processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $bdd=$db->getConnection();

    $user = new User($bdd);


    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Le mail ou le mot de passe est invalide.";
    }
}
?>

<!-- Login Page -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="connexion.css?v=1.0" rel="stylesheet">
    
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
                        <h1 class="header-title">BIENVENUE</h1>
                        <p class="header-subtitle">Amis de la Foire Aux Jouets</p>
                    </div>
                    <div class="col-2 text-right">
                        <a href="Connexion.html">
                            <button class="btn">
                                <span class="btn-text">CONNEXION</span>
                                <span class="btn-icon">
                                    <img src="IMAGE/user.png" alt="Connexion" class="btn-img">
                                </span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="connexion">
    <div class="col">
        <div class="titre">
            <h1>Connectez-vous à votre compte AFAJ</h1>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
        <div class="champsConnexion">
            <form method="post" action="">
                <div class="mail">
                    <input type="text" id="email" name="email" placeholder="Entrez votre adresse email" required>
                </div>
                <br>
                <div class="mdp">
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <br>
                <div class="seConnecter">
                    <button class="btn1" type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col">
        <div class="titre">
            <h1>Créez votre compte AFAJ et devenez membre</h1>
        </div>
    </div>
    </section>


    
</body>

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

</html>
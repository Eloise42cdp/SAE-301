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
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="email">email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login :</button>
    </form>


</body>
</html>

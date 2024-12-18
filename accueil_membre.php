<?php
include "header_membre.php";
include_once "class/bdd.php";
include_once "class/user.php";
//$db = (new Database())->getConnection();
//$user = new User($db);

$db = new Database();
$bdd = $db->getConnection();
$user = new User($bdd);

// Si pas de connexion ou pas le role membre, on quite l'espace membre
if (!$user->isLoggedIn() || $user->role != "membre") {
    header("Location: connexion.php");
    exit;
}

echo "<br>Espace Membre:" . $user->role;
?>
<!-- Titre principal -->
<h1 class="text-center mb-4">Nos points de collecte</h1>
<!-- Texte -->
<p class="text-center mb-4">
  <strong>Où récupérer les jouets ?<br>Sur cette carte vous pourrez retrouver tous nos points de collecte.</strong>
</p>
<div class="row align-items-center">
  <!-- Colonne pour le texte (à gauche) -->
  <div class="col-md-5 d-flex flex-column align-items-center">
    <div class="text-left">
      <p>
        <strong>ROANNE</strong><br>
        <img class="iconeMap" src="img/epingle-2.png">
        Club Suzanne Lacore - 29 rue Bravard<br>
        <img class="iconeMap" src="img/epingle-5.png">
        Club Jean Puy - 5 rue Jean Puy<br>
        <img class="iconeMap" src="img/epingle-6.png">
        Centre social La Livatte - 97 rue A. Thomas<br><br>

        <strong>RIORGES</strong><br>
        <img class="iconeMap" src="img/epingle-7.png">
        Centre social - 1 place Jean Cocteau<br><br>

        <strong>LE COTEAU</strong><br>
        <img class="iconeMap" src="img/epingle-4.png">
        Centre social - 3 rue Auguste Gelin<br><br>

        <strong>CHARLIEU</strong><br>
        <img class="iconeMap" src="img/epingle-8.png">
        M.J.C. - 1 rue du Pont de Pierre<br><br>

        <strong>SAINT JULIEN DE JONZY</strong><br>
        <img class="iconeMap" src="img/epingle.png">
        Decheterie - Lieu dit La Thuillere
      </p>
    </div>
  </div>

  <!-- Colonne pour la carte (à droite) -->
  <div class="col-md-7">
    <div id="map"></div>
  </div>
</div>
</div>

<!-- Intégration de Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="js/carte.js"></script>
<br>

<h1 class="text-center mb-4">Informations relatives aux choix de votre profil</h1>
<section class="block">
<?php
$query = "SELECT 
    E.Id_Evenement,
    E.adresse,
    E.dateDebut,
    E.dateFin,
    E.nom AS NomEvenement,
    JT.nom AS NomJouerType,
    M.Id_Membre,
    M.nom AS NomMembre,
    M.prenom
    FROM 
        Evenement E
    JOIN 
        EvenementType ET ON E.Id_Evenement = ET.Id_Evenement
    JOIN 
        JouerType JT ON ET.Id_JouerType = JT.Id_JouerType
    JOIN 
        MembreDroit MD ON JT.Id_JouerType = MD.Id_JouerType
    JOIN 
        Membre M ON MD.Id_Membre = M.Id_Membre
    WHERE 
        M.Id_Membre = :id_membre"; //[ID_DU_MEMBRE] "; //AND JT.Id_JouerType = [ID_JOUERTYPE];";

echo "<br>SQL:" . $query;
// Préparer la requête
$stmt = $bdd->prepare($query);

// Binder les paramètres
$stmt->bindParam(':id_membre', $user->IdUser, PDO::PARAM_INT);
echo "<br>ID User : " . $user->IdUser;
// Exécuter la requête
$stmt->execute();

/*
    // Afficher les résultats
    echo "<h2>Liste des événements et des types de jeu</h2>";
    echo "<table border='1'>
            <tr>
                <th>Id Événement</th>
                <th>Nom Événement</th>
                <th>Adresse</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Type de Jeu</th>
                <th>Nom Membre</th>
                <th>Prénom</th>
            </tr>";

    // Récupérer les données
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['Id_Evenement']}</td>
                <td>{$row['NomEvenement']}</td>
                <td>{$row['adresse']}</td>
                <td>{$row['dateDebut']}</td>
                <td>{$row['dateFin']}</td>
                <td>{$row['NomJouerType']}</td>
                <td>{$row['NomMembre']}</td>
                <td>{$row['prenom']}</td>
            </tr>";
    }
    echo "</table>";
*/

// Affichage
// Récupérer les données
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<h1>" . $row['NomJouerType'] . "</h1>";
    echo "<br><p><strong>Horaires :</strong></p>";

    //echo "<br>debut".$row['dateDebut'];
    //echo "<br>fin".$row['dateFin'];
    $dateDebut = new DateTime($row['dateDebut']);
    $dateFin = new DateTime($row['dateFin']);
    $jourDebut = $dateDebut->format('l'); // Jour complet en anglais (ex: Monday)
    $jourDebutFR = translateDayToFrench($jourDebut); // Traduction en français
    $heureDebut = $dateDebut->format('H\hi'); // Heures et minutes (ex: 18h00)

    $jourFin = $dateFin->format('l');
    $jourFinFR = translateDayToFrench($jourFin);
    $heureFin = $dateFin->format('H\hi'); // Heures et minutes

    echo "<p>Début : {$jourDebutFR} - {$heureDebut}</p>";
    echo "<p>Fin : {$jourFinFR} - {$heureFin}</p>";
    echo "<br><p><strong>Adresse:</strong></p>";
    echo "<p>" . $row['adresse'] . "</p>";
}


// Fonction pour traduire les jours en français
function translateDayToFrench($day)
{
    $days = [
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche'
    ];
    return $days[$day] ?? $day;
}
?>
</section>
<?php
include_once "footer.php";
?>
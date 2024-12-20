<?php
include_once "header_membre.php";
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

echo "<br>Bonjour " . $user->GetNameMembre() . " !";
?>
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
        evenement E
    JOIN 
        evenementtype ET ON E.Id_Evenement = ET.Id_Evenement
    JOIN 
        jouertype JT ON ET.Id_JouerType = JT.Id_JouerType
    JOIN 
        membredroit MD ON JT.Id_JouerType = MD.Id_JouerType
    JOIN 
        membre M ON MD.Id_Membre = M.Id_Membre
    WHERE 
        M.Id_Membre = :id_membre"; //[ID_DU_MEMBRE] "; //AND JT.Id_JouerType = [ID_JOUERTYPE];";


// Préparer la requête
$stmt = $bdd->prepare($query);

// Binder les paramètres
$stmt->bindParam(':id_membre', $user->IdUser, PDO::PARAM_INT);

// Exécuter la requête
$stmt->execute();

?>
<div class="carte container my-5">
<!-- Bouton Profil -->
<a href="admin_profil.php" class="btnD profile-button">Profil</a>
<!-- Point de colecte -->
  <!-- Titre principal -->
  <h1 class="text-center mb-4">Nos points de collecte</h1>
  <!-- Texte -->
  <p class="text-center mb-4">
    <strong>Où déposer vos jouets ?<br>
      Sur cette carte vous pourrez retrouver tous nos points de collecte.
    </strong>
  </p>
  <div class="row align-items-center">
    <!-- Colonne pour le texte (à gauche) -->
    <div class="col-12 col-md-5 d-flex flex-column align-items-center">
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
    <div class="col-12 col-md-7">
      <div id="map"></div>
    </div>
  </div>
  <hr>
</div>



<br>

  <h2 style="text-align: center;">Informations relatives aux choix de votre profil</h2>


<div class="block">
  <?php
  // Affichage
  // Récupérer les données
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<h1>" . $row['NomJouerType'] . "</h1>";
    echo "Horaire:";

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

    echo "Début : {$jourDebutFR} - {$heureDebut}<br>";
    echo "Fin : {$jourFinFR} - {$heureFin}</p>";

    echo "Adresse:";
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
</div>
<!-- Intégration de Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="js/carte.js"></script>

<?php
include_once "footer.php";
?>
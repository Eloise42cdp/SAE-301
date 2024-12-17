<?php
include_once "header.php";
include_once "carrousel.php";
?>
 
<!-- Qui sommes nous ? -->
<div class="container my-5">
    <div class="row equal-height">
        <!-- Section Image -->
        <div class="col-md-6">
            <img src="img/flyer.jpg" alt="Foire aux Jouets" class="img-fluid img-equal">
        </div>
        <!-- Section Texte -->
        <div class="col-md-6 d-flex">
            <div class="d-flex flex-column justify-content-between">
                <h2 class="fw-bold">Qui sommes nous ?</h2>
                <p class="text-justify">
                    Depuis la 1ère foire aux jouets, en 1985, l'association des <strong>Amis de la Foire aux Jouets</strong> (AFAJ),
                    basée à Mably près de Roanne, récolte des fonds grâce à différentes actions.
                    L'AFAJ agit en partenariat avec les <strong>Amis des Enfants du Monde (AEM)</strong>, ONG qui œuvre dans 14 pays
                    pour nourrir, soigner, éduquer les enfants démunis.
                </p>
                <p class="text-justify">
                    Notre association consiste tout simplement à récupérer dans plusieurs centres de collectes des jouets pour enfants
                    (peluche, jeux de société, jeux électroniques etc.) et également à les réparer si nécessaire pour ensuite les revendre
                    lors de la Foire aux Jouets, l'événement annuel de notre association. Les bénéfices vont aux AEM.
                </p>
            </div>
        </div>
    </div>
    <!-- Section Objectif -->
    <div class="text-center mt-4">
        <h3 class="fw-bold">Notre OBJECTIF, soutenir des actions humanitaires en direction des enfants du monde</h3>
    </div>
</div>
<div class="container my-5">
 
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
 
<!-- Membres du Bureau -->
<div class="container my-5">
    <h2 class="text-center fw-bold">Les membres du bureau</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <!-- Première étiquette -->
        <div class="col">
            <div class="card member-card">
                <img src="img/president.png" alt="M. MARQUIS Jean-François" class="member-image">
                <div class="card-body">
                    <h5 class="card-title">M. MARQUIS Jean-François</h5>
                    <p class="card-text">Président</p>
                </div>
            </div>
        </div>
        <!-- Deuxième étiquette -->
        <div class="col">
            <div class="card member-card">
                <img src="img/tresoriere.png" alt="Mme VIAL Brigitte" class="member-image">
                <div class="card-body">
                    <h5 class="card-title">Mme VIAL Brigitte</h5>
                    <p class="card-text">Trésorière</p>
                </div>
            </div>
        </div>
        <!-- Troisième étiquette -->
        <div class="col">
            <div class="card member-card">
                <img src="img/secretaire.png" alt="Mme MOREL Marie Claude" class="member-image">
                <div class="card-body">
                    <h5 class="card-title">Mme MOREL Marie Claude</h5>
                    <p class="card-text">Secrétaire</p>
                </div>
            </div>
        </div>
    </div>
</div>
 
<?php
include_once "footer.php";
?>
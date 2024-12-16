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
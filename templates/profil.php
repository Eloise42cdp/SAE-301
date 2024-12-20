<div id="btnDeconnexion">
    <a href="accueil_admin.php">
        <button class="btnD">
            <span class="btn-text">Retour page Admin</span>
            <span class="btn-icon">
                <img src="img/user.png" alt="Retour à la page admin" class="btn-img">
            </span>
        </button>
    </a>
</div>

<div class="block">
<h2>Mes informations</h2>
<div id="message-ajax"></div>
<div class="champs">
<form id="form_profil">
    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" required><br>
    
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" required><br>
    
    <label for="email">Adresse mail</label>
    <input type="email" id="email" name="email" required><br>
    
    <label for="datenaissance">Date de naissance</label>
    <input type="date" id="datenaissance" name="datenaissance" required><br>
    
    <label for="phone">Téléphone :</label>
    <input type="tel" id="tel" name="tel" maxlength="20"><br>
    
    <h6>Je souhaite participer :</h6>
    <div class="checkbox">
        <label>
            <input type="checkbox" id="select-all"> Aux collectes des jouets
        </label>
        <label>
            <input type="checkbox" id="deselect-all"> Ne sais pas
        </label>
    </div><br>
    <?php
    /*
        $db = new Database();
        $bdd = $db->getConnection();
        $query = "SELECT * FROM jouertype ORDER BY nom";
        $resultats_JouerOption = $bdd->query($query);
        $tab_JouerOption = $resultats_JouerOption->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tab_JouerOption as $value) {
            echo "<label>";
            echo '<input type="checkbox" class="options" name="JouerType[]" value="' . $value['Id_JouerType'] . '">' . $value['nom'];
            echo "</label>";
        }
        */
    ?>
    <div id="jouer-options"></div>
    <button class="btnB" type="submit">Valider</button><br><br>
</form>
</div>
</div>
<script>
    const formProfil = document.getElementById('form_profil');
    const messageDivAjax = document.getElementById('message-ajax');

    // À la soumission du formulaire, on envoie l'update via AJAX
    formProfil.addEventListener('submit', function(e) {
        e.preventDefault(); // empêcher la soumission classique

        // Collecter les données du formulaire
        const formData = new FormData(formProfil);
        formData.append('action', 'update_profil'); // Indique l'action côté PHP

        // Ajouter manuellement les cases à cocher non cochées pour qu'elles soient envoyées comme "non cochées"
        const checkboxes = document.querySelectorAll('.options');
        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                formData.append(checkbox.name, 0); // Envoyer "0" pour les cases non cochées
            }
        });

        // Envoyer les données via fetch
        fetch('ajax/profil.php', {
            method: 'POST',
            body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('message-ajax').innerHTML = '<p style="color:green;">Les informations ont été sauvegardées avec succès.</p>';
                } else {
                    document.getElementById('message-ajax').innerHTML = '<p style="color:red;">Erreur : ' + data.message + '</p>';
                }

                // Faire disparaître le message après 3 secondes
                setTimeout(() => {
                    document.getElementById('message-ajax').innerHTML = '';
                }, 3000);
            })
            .catch(error => {
                console.error('Erreur lors de l\'envoi des données :', error);
                document.getElementById('message-ajax').innerHTML = '<p style="color:red;">Erreur AJAX : ' + error + '</p>';
            });    
    });

    

    // Charger les informations avec fetch et then
    document.addEventListener('DOMContentLoaded', () => {
        fetch('ajax/profil.php?action=load_profil')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const profilData = data.data;

                    // Remplir les champs du formulaire
                    document.getElementById('prenom').value = profilData.prenom;
                    document.getElementById('nom').value = profilData.nom;
                    document.getElementById('email').value = profilData.email;
                    document.getElementById('datenaissance').value = profilData.datenaissance;
                    document.getElementById('tel').value = profilData.tel;

                    // Générer les cases à cocher
                    let optionsHtml = '';
                    profilData.jouerOptions.forEach(option => {
                        // Débogage : vérifier chaque option
                        console.log(`Option : ${option.nom}, Checked : ${option.checked}`);
                        optionsHtml += ` 
                            <label>
                                <input type="checkbox" class="options" name="JouerType[]" value="${option.Id_JouerType}" 
                                ${option.checked == 1 ? 'checked' : ''}>
                                ${option.nom}
                            </label><br>`;

                    });
                    $('#jouer-options').html(optionsHtml);

                } else {
                    document.getElementById('message-ajax').innerHTML = '<p style="color:red;">Erreur : ' + data.message + '</p>';
                }

                // Faire disparaître le message au bout de 3 secondes
                setTimeout(() => {
                    document.getElementById('message-ajax').innerHTML = '';
                }, 3000);
            })
            .catch(error => {
                //console.error('Erreur lors du chargement des données :', error);
                document.getElementById('message-ajax').innerHTML = '<p style="color:red;">Erreur AJAX : ' + error + '</p>';
            });
    });



</script>
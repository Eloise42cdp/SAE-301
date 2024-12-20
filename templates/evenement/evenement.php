<div id="btnDeconnexion" style="margin-left: 10%">
        <a href="accueil_admin.php">
            <button class="btnC">
                <span class="btn-text">Retour page Administrateur</span>
                <span class="btn-icon">
                    <img src="img/user.png" alt="Retour à la page admin" class="btn-img">
                </span>
            </button>
        </a>
    </div>
    <!-- Formulaire de modification -->
    <section class="block">
    <h2>Ajouter un événement</h2>
    <div class="champs">
        <form method="POST" action="admin_evenement.php">
            <label for="nom_evenement">Nom événement :</label><br>
            <input type="text" id="nom_evenement" name="nom_evenement" required><br><br>
        
            <label for="date_de_debut">Date et heure de début :</label><br>
            <input type="datetime-local" id="date_de_debut" name="date_de_debut" required><br><br>
        
            <label for="date_de_fin">Date et heure de fin :</label><br>
            <input type="datetime-local" id="date_de_fin" name="date_de_fin" required><br><br>
        
            <label for="lieu">Lieu :</label><br>
            <input type="text" id="lieu" name="lieu" required><br><br>

        <?php

$db = new Database();
$bdd=$db->getConnection();
$query = "SELECT * FROM jouertype ORDER BY nom";
$resultats_JouerOption=$bdd->query($query);
$tab_JouerOption = $resultats_JouerOption->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab_JouerOption as $value) {
    echo "<label>";
    echo '<input type="checkbox" class="options" name="JouerType[]" value="'.$value['Id_JouerType'].'">'.$value['nom'];
    echo "</label>";
}
?>
            <input type="hidden" name="action" value="ajout_evenement">
            <button class="btnB" type="submit">Ajouter</button>
        </form>
    </div>
</section>
<section class="block">
    <!-- Formulaire de modification -->
    <h2>Modifier un événement</h2>
    <div id="message"></div>
        <div class="champs">
            <form id="form_modifier_event">
                <label for="evenement">Sélectionner un événement :</label><br>
                <select name="id_evenement" id="evenement" required>
                <option value="" disabled selected>-- Sélectionnez --</option>
                <?php
                    // Récupérer la liste des événements
                    $sql = "SELECT id_Evenement, nom FROM evenement";
                    $stmt = $bdd->query($sql);
                    //$stmt->execute();
                    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($evenements as $evenement) {
                        echo'<option value="'.$evenement['id_Evenement'].'">'.$evenement['nom'].'</option>';
                    }
                ?>

                </select><br><br>
                <?php
                    // Charge les informations de l'événement en cours

                ?>
                <label for="nom">Nom événement :</label><br>
                <input type="text" id="nom" name="nom" required><br><br>
                <label for="dateDebut">Date et heure de début :</label><br>
                <input type="datetime-local" id="dateDebut" name="dateDebut" required step="60"><br><br>
                <label for="dateFin">Date et heure de fin :</label><br>
                <input type="datetime-local" id="dateFin" name="dateFin" required step="60"><br><br>
                <label for="adresse">Lieu :</label><br>
                <input type="text" id="adresse" name="adresse" required><br><br>

                <input type="hidden" name="action" value="modif_evenement">
                <input type="hidden" id="id_evenement" name="id_evenement" value="">

                <button class="btnB" type="submit">MODIFIER</button><br><br>
                
            </form>
        </div>
</section>
    <script>
        // Sélection du <select> et du formulaire
        const selectEvent = document.getElementById('evenement');
        const form = document.getElementById('form_modifier_event');

        const inputId       = document.getElementById('id_evenement');
        const inputNom      = document.getElementById('nom');
        const inputDateDeb  = document.getElementById('dateDebut');
        const inputDateFin  = document.getElementById('dateFin');
        const inputAdresse  = document.getElementById('adresse');

        const messageDiv    = document.getElementById('message');

        // Quand on change l'événement sélectionné, on récupère ses infos via AJAX
        selectEvent.addEventListener('change', function() {
            const id = this.value;
            if (!id) return;

            // Faire un appel AJAX (fetch) vers le script PHP pour récupérer les infos de l’événement
            fetch('ajax/modif_evenement.php?action=get_event&id=' + id)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remplir les champs du formulaire avec les données récupérées
                        inputId.value      = data.evenement.id_Evenement;
                        inputNom.value     = data.evenement.nom;
                        inputDateDeb.value = data.evenement.DateDebut.replace(' ', 'T');
                        inputDateFin.value = data.evenement.DateFin.replace(' ', 'T');
                        inputAdresse.value = data.evenement.Adresse;
                    } else {
                        messageDiv.innerHTML = '<p style="color:red;">Erreur: ' + data.message + '</p>';
                    }
                    // Faire disparaître le message au bout de 3 secondes
                    setTimeout(() => {
                        messageDiv.innerHTML = '';
                    }, 3000);
                })
                .catch(error => {
                    console.error(error);
                    messageDiv.innerHTML = '<p style="color:red;">Erreur AJAX: ' + error + '</p>';
                });
        });

        // À la soumission du formulaire, on envoie l'update via AJAX
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // empêcher la soumission classique

            // Récupérer les données du formulaire
            const formData = new FormData(form);
            formData.append('action', 'update_event'); // Indique l'action côté PHP

            // Appel AJAX (POST) pour mettre à jour l’événement
            fetch('ajax/modif_evenement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = '<p style="color:green;">Événement mis à jour avec succès!</p>';
                } else {
                    messageDiv.innerHTML = '<p style="color:red;">Erreur: ' + data.message + '</p>';
                }
                // Faire disparaître le message au bout de 3 secondes
                setTimeout(() => {
                    messageDiv.innerHTML = '';
                }, 3000);
            })
            .catch(error => {
                console.error(error);
                messageDiv.innerHTML = '<p style="color:red;">Erreur AJAX: ' + error + '</p>';
            });
        });
   
    </script>
    <section class="block">
    <!-- Formulaire pour supprimer -->
    <h2>Supprimer un événement</h2>
    <div id="message-sup"></div>
    <div class="champs">
    <form id="form_sup_event">
        <label for="nom">Nom de l'événement :</label><br>
        <select name="evenement-sup" id="evenement-sup" required>

        <option value="" disabled selected>-- Sélectionnez --</option>
        <?php
            // Récupérer la liste des événements
            $sql = "SELECT id_Evenement, nom FROM evenement";
            $stmt = $bdd->query($sql);
            //$stmt->execute();
            $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($evenements as $evenement) {
                echo'<option value="'.$evenement['id_Evenement'].'">'.$evenement['nom'].'</option>';
            }
        ?>
        </select><br><br>
        <button class="btnB" type="submit">SUPPRIMER</button><br><br>
    </form>
        </div>
        </section>
    <script>
        // Sélection du <select> et du formulaire
        const selectEventSup = document.getElementById('evenement-sup');
        const formSup = document.getElementById('form_sup_event');
        const messageDivSup = document.getElementById('message-sup');

        // À la soumission du formulaire, on envoie l'update via AJAX
        formSup.addEventListener('submit', function(e) {
            e.preventDefault(); // empêcher la soumission classique

            // Récupérer les données du formulaire
            const formData = new FormData(formSup);
            formData.append('action', 'del_event'); // Indique l'action côté PHP

            // Appel AJAX (POST) pour mettre à jour l’événement
            fetch('ajax/modif_evenement.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // la valeur sélectionnée dans le <select>.
                    const idSupprime = formData.get('evenement-sup'); 
            
                    // Supprimer l'option correspondante dans le <select>
                    const optionToRemove = document.querySelector(`#evenement-sup option[value="${idSupprime}"]`);
                    if (optionToRemove) {
                        optionToRemove.remove();
                    }

                    messageDivSup.innerHTML = '<p style="color:green;">Événement mis à jour avec succès!</p>';
                    
                } else {
                    messageDivSup.innerHTML = '<p style="color:red;">Erreur: ' + data.message + '</p>';
                }
                // Faire disparaître le message au bout de 3 secondes
                setTimeout(() => {
                    messageDivSup.innerHTML = '';
                }, 3000);
            })
            .catch(error => {
                console.error(error);
                messageDivSup.innerHTML = '<p style="color:red;">Erreur AJAX: ' + error + '</p>';
            });

        });
    </script>
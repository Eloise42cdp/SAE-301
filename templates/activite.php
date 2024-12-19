<?php
     $query='SELECT nom, Id_JouerType FROM jouertype';
     $stmt = $db->query($query);
     $activites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="liste" style="margin-left: 10%">
    <div id="btnDeconnexion">
        <a href="accueil_admin.php">
            <button class="btnC">
                <span class="btn-text">Retour page Administrateur</span>
                <span class="btn-icon">
                    <img src="img/user.png" alt="Retour à la page admin" class="btn-img">
                </span>
            </button>
        </a>
    </div>
    <?php
        foreach ($activites as $activite) { ?>
            <div class="listeActivite"><p><?php
                echo "<br>".$activite['Id_JouerType'].". ".$activite['nom'];?></p>
            </div>
    <?php   }
    ?>
</div> 
<section class="block">
<h2>Ajouter une activité :<h2>
<div class="champs"> 
    <form>
        <label for="nom">Nom de l'activité :</label>
        <input class="champs" type="text" name="nom" required>
        <button class="btnB" type="submit">Ajouter</button><br><br>
    </form>
</div>
</section>

<script>
    const formActivite = document.getElementById('form_ajouter_activite');
    const messageDivAjouter = document.getElementById('message-ajouter');

    // À la soumission du formulaire, on envoie l'update via AJAX
    formActivite.addEventListener('submit', function(e) {
        e.preventDefault(); // empêcher la soumission classique

        // Récupérer les données du formulaire
        const formData = new FormData(formActivite);
        formData.append('action', 'ajouter_activite'); // Indique l'action côté PHP

        // Appel AJAX (POST) pour mettre à jour l’événement
        fetch('ajax/activite.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDivAjouter.innerHTML = '<p style="color:green;">L\'activité a bien été ajouté avec succès!</p>';
            } else {
                messageDivAjouter.innerHTML = '<p style="color:red;">Erreur: ' + data.message + '</p>';
            }
            // Faire disparaître le message au bout de 3 secondes
            setTimeout(() => {
                messageDivAjouter.innerHTML = '';
            }, 3000);
        })
        .catch(error => {
            console.error(error);
            messageDivAjouter.innerHTML = '<p style="color:red;">Erreur AJAX: ' + error + '</p>';
        });
    });
</script>

<section class="block">
<h2>Supprimer une activité :<h2>
<div class="champs">
<form id="form_supprimer_activite">
    <label for="membre">Sélectionner une activité :</label><br>
    <select name="activite-sup" id="activite-sup" required>
    <option value="" disabled selected>-- Sélectionnez --</option>
    <?php
        $db = new Database();
        $bdd=$db->getConnection();
        // Récupérer la liste des activité
        $sql = "SELECT Id_JouerType, nom FROM jouertype";
        $stmt = $bdd->query($sql);
        //$stmt->execute();
        $activites = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($activites as $activite) {
            echo'<option value="'.$activite['Id_JouerType'].'">'.$activite['nom'].'</option>';
        }
    ?>
    </select>
    <button class="btnB" type="submit">Supprimer</button><br><br>
</form>
    </div>
    </section>

<script>
    // Sélection du <select> et du formulaire
    const selectActiviteSup = document.getElementById('activite-sup');
    const formSupActivite = document.getElementById('form_supprimer_activite');
    const messageDivSup = document.getElementById('message-supprimer');

    // À la soumission du formulaire, on envoie l'update via AJAX
    formSupActivite.addEventListener('submit', function(e) {
        e.preventDefault(); // empêcher la soumission classique

        // Récupérer les données du formulaire
        const formData = new FormData(formSupActivite);
        formData.append('action', 'del_activite'); // Indique l'action côté PHP

        // Appel AJAX (POST) pour mettre à jour l’événement
        fetch('ajax/activite.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // la valeur sélectionnée dans le <select>.
                const idSupprime = formData.get('activite-sup'); 
        
                // Supprimer l'option correspondante dans le <select>
                const optionToRemove = document.querySelector(`#activite-sup option[value="${idSupprime}"]`);
                if (optionToRemove) {
                    optionToRemove.remove();
                }

                messageDivSup.innerHTML = '<p style="color:green;">Activité supprimé avec succès!</p>';
                
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
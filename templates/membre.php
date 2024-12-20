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
</div>

<section class="block">
    <h2>Supprimer le profil d’un membre :<h2>
    <div class="champs">
        <form id="form_sup_membre">
            <label for="membre">Sélectionner un membre :</label><br>
            <select name="membre-sup" id="membre-sup" required>
                <option value="" disabled selected>-- Sélectionnez --</option>
                <?php
                    $db = new Database();
                    $bdd=$db->getConnection();
                    // Récupérer la liste des membres
                    $sql = "SELECT Id_Membre, nom, prenom FROM membre";
                    $stmt = $bdd->query($sql);
                    //$stmt->execute();
                    $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($membres as $membre) {
                        echo'<option value="'.$membre['Id_Membre'].'">'.$membre['nom'].' '.$membre['prenom'].'</option>';
                    }
                ?>
            </select>
            <button class="btnB" type="submit">Supprimer</button><br><br>
        </form>
        </div>
</section>
<script>
    // Sélection du <select> et du formulaire
    const selectMembreSup = document.getElementById('membre-sup');
    const formSupMembre = document.getElementById('form_sup_membre');
    const messageDivSup = document.getElementById('message-sup');

    // À la soumission du formulaire, on envoie l'update via AJAX
    formSupMembre.addEventListener('submit', function(e) {
        e.preventDefault(); // empêcher la soumission classique

        // Récupérer les données du formulaire
        const formData = new FormData(formSupMembre);
        formData.append('action', 'del_membre'); // Indique l'action côté PHP

        // Appel AJAX (POST) pour mettre à jour l’événement
        fetch('ajax/membre.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // la valeur sélectionnée dans le <select>.
                const idSupprime = formData.get('membre-sup'); 
        
                // Supprimer l'option correspondante dans le <select>
                const optionToRemove = document.querySelector(`#membre-sup option[value="${idSupprime}"]`);
                if (optionToRemove) {
                    optionToRemove.remove();
                }

                messageDivSup.innerHTML = '<p style="color:green;">Membre supprimé avec succès!</p>';
                
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



// Initialisation de la carte centrée sur une latitude et une longitude spécifiques
let map = L.map('map').setView([46.1, 4.05], 9);

// Ajout d'une couche de tuiles OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Fonction pour charger les adresses depuis le serveur
function loadAddresses() {
    fetch('get_adresses.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur de récupération des données');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error(data.error);
            } else {
                data.forEach(adresse => {
                    L.marker([adresse.latitude, adresse.longitude])
                        .addTo(map)
                        .bindPopup(adresse.description);
                });
            }
        })
        .catch(error => console.error('Erreur lors du chargement des adresses:', error));
}



// Écouteur d'événements pour le formulaire d'ajout d'adresse
document.getElementById('addAddressForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('ajout_adresse.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Adresse ajoutée avec succès !');
            refreshMap();  // Rafraîchir la carte pour afficher la nouvelle adresse
            this.reset();  // Réinitialiser le formulaire
        } else {
            alert('Erreur : ' + result.error);
        }
    })
    .catch(error => console.error('Erreur lors de l\'ajout de l\'adresse :', error));
});

// Charger les adresses depuis la BDD au chargement de la page
loadAddresses();

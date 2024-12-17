// Initialisation de la carte centrée sur une latitude et une longitude spécifiques
let map = L.map('map').setView([46.1, 4.05], 9);

// Ajout d'une couche de tuiles OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Définition des points de collecte avec des coordonnées et des descriptions
let pointsCollecte = [
    { coord: [46.0412, 4.0682], description: 'Roanne - Club Suzanne Lacore, 29 rue Bravard', color: 'yellow' },
    { coord: [46.0359, 4.0695], description: 'Roanne - Club Jean Puy - 5 rue Jean Puy', color: 'blue' },
    { coord: [46.0334, 4.0705], description: 'Roanne - Centre social La Livatte - 97 rue A. Thomas', color: 'green' },
    { coord: [46.0308, 4.0689], description: 'Riorges - Centre social, 1 place Jean Cocteau', color: 'orange' },
    { coord: [46.0279, 4.0650], description: 'Le Coteau - Centre social, 3 rue Auguste Gelin', color: 'pink' },
    { coord: [46.1478, 4.0317], description: 'Charlieu - M.J.C., 1 rue du Pont de Pierre', color: 'red' },
    { coord: [46.2089, 4.0725], description: 'Saint Julien de Jonzy - Déchetterie, Lieu dit La Thuillere', color: 'purple' }
];

// Fonction pour ajouter des marqueurs avec des couleurs personnalisées
pointsCollecte.forEach(point => {
    L.circleMarker(point.coord, {
        color: point.color,
        radius: 10,
        fillOpacity: 0.8
    }).addTo(map).bindPopup(point.description);
});

// Fonction pour charger les adresses depuis la BDD
function loadAddresses() {
    fetch('get_adresses.php')  
        .then(response => response.json())
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
        .catch(error => console.error('Erreur de chargement des adresses:', error));
}


// Charger les adresses depuis la BDD au chargement de la page
loadAddresses();

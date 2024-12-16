// Initialisation de la carte Leaflet avec définition de sa position initiale et niveau de zoom
const map = L.map('map').setView([46.03, 4.03], 10);

// Ajout des tuiles OpenStreetMap comme fond de carte
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' // Attribution légale d'OpenStreetMap
}).addTo(map);

// Emplacements afficher sur la carte
const locations = [
    { name: "Club Suzanne Lacore", coord: [46.0335, 4.0625], color: "yellow" },
    { name: "Club Jean Puy", coord: [46.0342, 4.0673], color: "blue" },
    { name: "Centre social La Livatte", coord: [46.0318, 4.0689], color: "green" },
    { name: "Centre social", coord: [46.0187, 4.0641], color: "orange" },
    { name: "Centre social Auguste", coord: [46.0035, 4.0655], color: "pink" },
    { name: "MJC Pont de Pierre", coord: [45.9961, 4.0634], color: "purple" },
    { name: "SAINT JONZY", coord: [45.9998, 4.11], color: "red" },
];

// Ajout des marqueurs pour chaque emplacement
locations.forEach(location => {
    L.circleMarker(location.coord, { // Création d'un marqueur (cercle) pour chaque emplacement
        color: location.color, // Couleur du cercle définie
        radius: 8 // Taille du cercle
    })
    .addTo(map) // Ajout du cercle sur la carte
    .bindPopup(location.name); // Ajout d'une info-bulle avec le nom de l'emplacement
});

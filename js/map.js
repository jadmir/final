if(document.getElementById("mapa")){
    var map = L.map('mapa').setView([51.500001, -0.089884], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([51.500001, -0.089884], 13).addTo(map)
        .bindPopup('Bromind.<br> Boletos disponibles.')
        .openPopup();
}
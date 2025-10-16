// Inicializar el mapa
var map = L.map('map', { attributionControl: false }).setView([0, 0], 13); // Coordenadas iniciales

// Agregar capa de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Verificar si la variable 'ubicaciones' está definida
if (typeof ubicaciones !== 'undefined' && ubicaciones.length > 0) {
    // Agregar marcadores al mapa
    ubicaciones.forEach(function (ubicacion) {
        if (ubicacion.latitud && ubicacion.longitud) {
            L.marker([ubicacion.latitud, ubicacion.longitud])
                .addTo(map)
                .bindPopup(`<b>Dirección:</b> ${ubicacion.direccion}<br><b>Altitud:</b> ${ubicacion.altitud || 'N/A'}`);
        }
    });

    // Centrar el mapa en la primera ubicación
    var primeraUbicacion = ubicaciones[0];
    map.setView([primeraUbicacion.latitud, primeraUbicacion.longitud], 15);
} else {
    alert('No hay ubicaciones disponibles para este lote.');
}
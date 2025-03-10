document.addEventListener("DOMContentLoaded", function () {
    if (typeof mapLocations === "undefined" || !Array.isArray(mapLocations) || mapLocations.length === 0) {
        console.error("No valid map locations found.");
        return;
    }

    var mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container #map not found.");
        return;
    }

    // Initialize Leaflet map with a default center
    var map = L.map("map", { attributionControl: false }).setView([55.608314, -3.787285], 7); // Default to Lanarkshire

    // Use OpenStreetMap's Cycle Map layer from Thunderforest
    L.tileLayer("https://tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=ff6e50f5a0c7445082ef38637a69cab1", {
        maxZoom: 12
    }).addTo(map);

    // Iterate through `mapLocations` and add markers
    mapLocations.forEach(function (article) {
        if (article.latitude && article.longitude) {
            var markerIcon = L.divIcon({
                className: `${article.categoryClass.trim()}`, // Only apply category class here
                iconSize: [117, 117],
                html: article.markerHtml, // This ensures the inner div structure matches individual-event-map.js
            });
            
            var marker = L.marker([article.latitude, article.longitude], { icon: markerIcon }).addTo(map);
            
            marker.bindPopup(`
                <div class="uk-text-bold">${article.title}</div>
                <a href="${article.article_url}" class="uk-button uk-button-primary download_border twenty_six uk-text-white">
                    View Event
                </a>
            `);
            
        } else {
            console.warn("Missing coordinates for:", article.title);
        }
    });

    // Fit the map bounds to the markers if multiple exist
    var bounds = new L.LatLngBounds(mapLocations.map(article => [article.latitude, article.longitude]));
    if (mapLocations.length > 1) {
        map.fitBounds(bounds);
    }
});

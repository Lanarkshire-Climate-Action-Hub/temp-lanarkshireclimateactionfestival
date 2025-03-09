document.addEventListener("DOMContentLoaded", function () {
    if (typeof eventLatitude === "undefined" || typeof eventLongitude === "undefined") {
        console.error("Latitude and Longitude not set.");
        return;
    }

    var mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container #map not found.");
        return;
    }

    // Initialize Leaflet map
    var map = L.map("map", { attributionControl: false }).setView([eventLatitude, eventLongitude], 13);

    // Use OpenStreetMap's Cycle Map layer from Thunderforest
    L.tileLayer("https://tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=ff6e50f5a0c7445082ef38637a69cab1", {
        // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | &copy; <a href="https://www.thunderforest.com/">Thunderforest</a>',
        maxZoom: 18
    }).addTo(map);

    var customMarker = L.divIcon({
        className: 'circle-pin', // This links to the SCSS class
        iconSize: [117, 117], // Matches the SCSS size
        // html: '<div class="custom-marker">📍</div>' // Optional: You can add text or an icon inside
    });
    
    L.marker([eventLatitude, eventLongitude], { icon: customMarker }).addTo(map)
        // .bindPopup("Event Location")
        .openPopup();
    
});

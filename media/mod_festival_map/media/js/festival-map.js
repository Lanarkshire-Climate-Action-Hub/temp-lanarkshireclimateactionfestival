document.addEventListener("DOMContentLoaded", function () {
    if (typeof L === "undefined") {
        console.error("Leaflet.js is not loaded.");
        return;
    }

    if (!festivalMapData || festivalMapData.length === 0) {
        console.warn("No festival map data available.");
        return;
    }

    var mapContainer = document.getElementById("map");
    if (!mapContainer) {
        console.error("Map container #map not found.");
        return;
    }

    var map = L.map("map").setView([defaultLat, defaultLon], defaultZoom);

    L.tileLayer("https://tile.thunderforest.com/cycle/{z}/{x}/{y}.png?apikey=ff6e50f5a0c7445082ef38637a69cab1", {
        maxZoom: 12
    }).addTo(map);

    var categoryClasses = {
        12: "theme-color-energy",
        13: "theme-color-community-engagement",
        14: "theme-color-circularity",
        15: "theme-color-food-nature",
        16: "theme-color-travel"
    };

    festivalMapData.forEach(function (article) {
        if (article.latitude && article.longitude) {
            var markerIcon = L.divIcon({
                className: categoryClasses[article.category_id] || "theme-color-default",
                iconSize: [117, 117],
                html: '<div class="circle-pin"></div>'
            });

            var marker = L.marker([parseFloat(article.latitude), parseFloat(article.longitude)], { icon: markerIcon }).addTo(map);
            marker.bindPopup(`<div class="uk-text-bold">${article.title}</div>`);
        }
    });

    if (festivalMapData.length > 1) {
        var bounds = new L.LatLngBounds(festivalMapData.map(article => [parseFloat(article.latitude), parseFloat(article.longitude)]));
        map.fitBounds(bounds);
    }
});

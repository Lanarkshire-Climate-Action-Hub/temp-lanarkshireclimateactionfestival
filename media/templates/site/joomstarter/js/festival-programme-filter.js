document.addEventListener("DOMContentLoaded", function () {

    // Get references to filter elements
    const filterToggle = document.getElementById("filter-toggle");
    const filterContainer = document.getElementById("filter-container");
    const applyFilterButton = document.getElementById("apply-filter");
    const eventContainer = document.getElementById("events");
    const categoryFilter = document.getElementById("filter-category");
    const locationFilter = document.getElementById("filter-location");
    const dateFilter = document.getElementById("filter-date");
    const optionCheckboxes = document.querySelectorAll("input[name='filter-option']");
    
    // Event listener for the "Open Filter" button
    filterToggle.addEventListener("click", function (event) {
        event.preventDefault(); // Prevents page jump to "#"

        // Toggle visibility of filter container
        if (filterContainer.hidden) {
            filterContainer.hidden = false;
            filterToggle.textContent = "Close Filters"; // Change button text
        } else {
            filterContainer.hidden = true;
            filterToggle.textContent = "Open Filters"; // Reset button text
        }
    });

    // Ensure map is available
    if (typeof map === "undefined" || !map) {
        console.warn("Leaflet map not found");
        return;
    }

    // Event listener for the "Apply Filters" button
    applyFilterButton.addEventListener("click", function () {
        // Get selected filters
        const selectedCategory = categoryFilter.value;
        const selectedLocation = locationFilter.value.toLowerCase();
        const selectedDate = dateFilter.value;
        const selectedOptions = Array.from(optionCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        // Filter the events
        filterEvents(selectedCategory, selectedLocation, selectedDate, selectedOptions);
    });

    function filterEvents(category, location, date, options) {
        // Get all event items
        const eventItems = document.querySelectorAll("#events .uk-panel");

        // Reset map markers
        map.eachLayer(layer => {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Iterate through events and apply filters
        eventItems.forEach(eventItem => {
            const eventCategory = eventItem.dataset.category;
            const eventLocation = eventItem.dataset.location.toLowerCase();
            const eventDate = eventItem.dataset.date;
            const eventOptions = eventItem.dataset.options ? eventItem.dataset.options.split(",") : [];

            let isVisible = true;

            // Filter by category
            if (category && eventCategory !== category) {
                isVisible = false;
            }

            // Filter by location
            if (location && eventLocation !== location) {
                isVisible = false;
            }

            // Filter by date
            if (date && eventDate !== date) {
                isVisible = false;
            }

            // Filter by accessibility options
            if (options.length > 0 && !options.some(opt => eventOptions.includes(opt))) {
                isVisible = false;
            }

            // Show or hide event based on filters
            eventItem.style.display = isVisible ? "block" : "none";

            // Update map markers
            if (isVisible) {
                const lat = eventItem.dataset.latitude;
                const lng = eventItem.dataset.longitude;
                if (lat && lng) {
                    const marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup(`<div class="uk-text-bold">${eventItem.dataset.title}</div>`);
                }
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function () {

});

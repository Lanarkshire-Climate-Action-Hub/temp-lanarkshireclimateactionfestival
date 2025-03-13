document.addEventListener("DOMContentLoaded", function () {
    const filterToggle = document.getElementById("filter-toggle");
    const filterContainer = document.getElementById("filter-container");
    const filterButton = document.getElementById("apply-filter");
    const categoryFilter = document.getElementById("filter-category");
    const locationFilter = document.getElementById("filter-location");
    const eventItems = document.querySelectorAll(".event-item");

    // Step 1: Populate Location Dropdown Dynamically
    const locations = new Set(); // Store unique locations
    eventItems.forEach(event => {
        const eventLocation = event.getAttribute("data-location");
        if (eventLocation && eventLocation.trim() !== "") {
            locations.add(eventLocation.trim()); // Add location to the set
        }
    });

    // Add locations to dropdown
    locations.forEach(location => {
        const option = document.createElement("option");
        option.value = location;
        option.textContent = location;
        locationFilter.appendChild(option);
    });

    // Toggle the filter panel
    filterToggle.addEventListener("click", function (event) {
        event.preventDefault();
        filterContainer.hidden = !filterContainer.hidden;
    });

    // Apply filtering when the button is clicked
    filterButton.addEventListener("click", function () {
        const selectedWheelchair = document.querySelector("input[name='filter-option'][value='wheelchair']").checked;
        const selectedFamily = document.querySelector("input[name='filter-option'][value='family']").checked;
        const selectedCategory = categoryFilter.value;
        const selectedLocation = locationFilter.value;

        eventItems.forEach(event => {
            const parentContainer = event.closest('.uk-slider-items > div'); // Target parent for layout shift
            const eventCategory = event.getAttribute("data-category");
            const eventLocation = event.getAttribute("data-location");
            const isWheelchair = event.getAttribute("data-wheelchair") === "true";
            const isFamily = event.getAttribute("data-family") === "true";

            // Default to showing all events
            let showEvent = true;

            // Apply Category filter
            if (selectedCategory && eventCategory !== selectedCategory) {
                showEvent = false;
            }

            // Apply Location filter
            if (selectedLocation && eventLocation !== selectedLocation) {
                showEvent = false;
            }

            // Apply Accessibility filters
            if (selectedWheelchair && !isWheelchair) showEvent = false;
            if (selectedFamily && !isFamily) showEvent = false;

            // Apply filtering logic
            parentContainer.style.display = showEvent ? "block" : "none";
        });
    });
});

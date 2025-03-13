document.addEventListener("DOMContentLoaded", function () {
    const filterToggle = document.getElementById("filter-toggle");
    const filterContainer = document.getElementById("filter-container");
    const filterButton = document.getElementById("apply-filter");
    const eventItems = document.querySelectorAll(".event-item");

    // Toggle the filter panel
    filterToggle.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default behavior of the anchor tag
        filterContainer.hidden = !filterContainer.hidden; // Toggle visibility
    });

    // Apply filtering when the button is clicked
    filterButton.addEventListener("click", function () {
        const selectedWheelchair = document.querySelector("input[name='filter-option'][value='wheelchair']").checked;
        const selectedFamily = document.querySelector("input[name='filter-option'][value='family']").checked;

        eventItems.forEach(event => {
            const parentContainer = event.closest('.uk-slider-items > div'); // Find the direct parent container

            const isWheelchair = event.getAttribute("data-wheelchair") === "true";
            const isFamily = event.getAttribute("data-family") === "true";

            // If no filters are selected, show all events
            if (!selectedWheelchair && !selectedFamily) {
                parentContainer.style.display = "block";
                return;
            }

            // Determine visibility based on selected filters
            let showEvent = false;
            if (selectedWheelchair && isWheelchair) showEvent = true;
            if (selectedFamily && isFamily) showEvent = true;
            if (selectedWheelchair && selectedFamily && isWheelchair && isFamily) showEvent = true;

            parentContainer.style.display = showEvent ? "block" : "none";
        });
    });
});

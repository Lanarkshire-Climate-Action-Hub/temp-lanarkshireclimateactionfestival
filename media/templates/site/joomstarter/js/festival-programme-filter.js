document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("apply-filter");
    const eventItems = document.querySelectorAll(".event-item");

    filterButton.addEventListener("click", function () {
        const selectedWheelchair = document.querySelector("input[name='filter-option'][value='wheelchair']").checked;
        const selectedFamily = document.querySelector("input[name='filter-option'][value='family']").checked;

        eventItems.forEach(event => {
            const isWheelchair = event.getAttribute("data-wheelchair") === "true";
            const isFamily = event.getAttribute("data-family") === "true";

            // If no filters are selected, show all events
            if (!selectedWheelchair && !selectedFamily) {
                event.style.display = "block";
                return;
            }

            // Determine visibility based on selected filters
            let showEvent = false;
            if (selectedWheelchair && isWheelchair) showEvent = true;
            if (selectedFamily && isFamily) showEvent = true;
            if (selectedWheelchair && selectedFamily && isWheelchair && isFamily) showEvent = true;

            event.style.display = showEvent ? "block" : "none";
        });
    });
});

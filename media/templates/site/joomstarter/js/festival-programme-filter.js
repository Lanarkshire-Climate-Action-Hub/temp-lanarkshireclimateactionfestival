document.addEventListener("DOMContentLoaded", function () {
    const filterToggle = document.getElementById("filter-toggle");
    const filterContainer = document.getElementById("filter-container");
    const filterButton = document.getElementById("apply-filter");
    const resetButton = document.createElement("button");
    const categoryFilter = document.getElementById("filter-category");
    const locationFilter = document.getElementById("filter-location");
    const dateFilter = document.getElementById("filter-date");
    const eventItems = document.querySelectorAll(".event-item");
    const eventsContainer = document.getElementById("events");

    // Create and insert the Reset Filters button
    resetButton.textContent = "Reset Filters";
    resetButton.className = "uk-button uk-button-default download_border twenty_six event_details_button_padding uk-margin-small-top uk-margin-small-left";
    resetButton.type = "button"; // Prevents it from acting as a submit button
    filterButton.insertAdjacentElement("afterend", resetButton);

    // Create and insert the "Programme Updated" message below the buttons
    const messageWrapper = document.createElement("div");
    messageWrapper.className = "uk-margin-small-top";
    filterButton.parentElement.appendChild(messageWrapper);

    const filterMessage = document.createElement("p");
    filterMessage.textContent = "The programme has been updated.";
    filterMessage.style.display = "none";
    filterMessage.className = "uk-text-white";
    messageWrapper.appendChild(filterMessage);

    // Step 1: Populate Location Dropdown Dynamically
    const locations = new Set();
    eventItems.forEach(event => {
        const eventLocation = event.getAttribute("data-location");
        if (eventLocation && eventLocation.trim() !== "") {
            locations.add(eventLocation.trim());
        }
    });

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

    // Function to check if any events are visible under a date
    function updateNoEventsMessage() {
        document.querySelectorAll(".uk-slider-items").forEach(slider => {
            const visibleEvents = [...slider.querySelectorAll('.event-item')]
                .filter(item => item.closest('.uk-slider-items > div').style.display !== "none");

            let noEventsMessage = slider.parentElement.querySelector(".no-events-message");

            if (visibleEvents.length === 0) {
                if (!noEventsMessage) {
                    noEventsMessage = document.createElement("p");
                    noEventsMessage.className = "no-events-message uk-text-warning uk-text-center uk-margin-large";
                    noEventsMessage.textContent = "There is nothing planned.";
                    slider.parentElement.appendChild(noEventsMessage);
                }
            } else {
                if (noEventsMessage) {
                    noEventsMessage.remove();
                }
            }
        });
    }

    // Apply filtering when the button is clicked
    filterButton.addEventListener("click", function () {
        const selectedWheelchair = document.querySelector("input[name='filter-option'][value='wheelchair']").checked;
        const selectedFamily = document.querySelector("input[name='filter-option'][value='family']").checked;
        const selectedCategory = categoryFilter.value;
        const selectedLocation = locationFilter.value;
        const selectedDate = dateFilter.value;

        eventItems.forEach(event => {
            const parentContainer = event.closest('.uk-slider-items > div');
            const eventCategory = event.getAttribute("data-category");
            const eventLocation = event.getAttribute("data-location");
            const eventDate = event.getAttribute("data-date");
            const isWheelchair = event.getAttribute("data-wheelchair") === "true";
            const isFamily = event.getAttribute("data-family") === "true";

            let showEvent = true;

            // Apply Category filter
            if (selectedCategory && eventCategory !== selectedCategory) showEvent = false;

            // Apply Location filter
            if (selectedLocation && eventLocation !== selectedLocation) showEvent = false;

            // Apply Date filter
            if (selectedDate && eventDate !== selectedDate) showEvent = false;

            // Apply Accessibility filters
            if (selectedWheelchair && !isWheelchair) showEvent = false;
            if (selectedFamily && !isFamily) showEvent = false;

            parentContainer.style.display = showEvent ? "block" : "none";
        });

        // Show "The programme has been updated" message
        filterMessage.style.display = "block";

        // Update "There is nothing planned" messages
        updateNoEventsMessage();
    });

    // Reset filters when Reset button is clicked
    resetButton.addEventListener("click", function (event) {
        event.preventDefault(); // Prevents redirection to "/?"
        categoryFilter.value = "";
        locationFilter.value = "";
        dateFilter.value = "";
        document.querySelector("input[name='filter-option'][value='wheelchair']").checked = false;
        document.querySelector("input[name='filter-option'][value='family']").checked = false;

        eventItems.forEach(event => {
            event.closest('.uk-slider-items > div').style.display = "block";
        });

        // Hide "Programme Updated" message
        filterMessage.style.display = "none";

        // Remove all "There is nothing planned" messages
        document.querySelectorAll(".no-events-message").forEach(msg => msg.remove());
    });
});

function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

function filterPlaces() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let placesContainer = document.getElementById("placesContainer");
    let places = placesContainer.getElementsByClassName("place");

    for (let i = 0; i < places.length; i++) {
        let placeName = places[i].getElementsByTagName("h3")[0].textContent;
        if (placeName.toUpperCase().indexOf(filter) > -1) {
            places[i].style.display = "";
        } else {
            places[i].style.display = "none";
        }
    }
}
function highlightEvent(element) {
    // Remove the 'selected' class from all event boxes
    document.querySelectorAll('.event-box').forEach(box => {
        box.classList.remove('selected');
    });

    // Add the 'selected' class to the clicked event
    element.classList.add('selected');
}
// JavaScript (add in script.js)
window.onscroll = function() {
    document.getElementById("backToTop").style.display = window.scrollY > 500 ? "block" : "none";
};

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
function openFoodModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeFoodModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}



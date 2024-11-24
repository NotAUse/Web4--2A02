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
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
};
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

// Show modal function
function showModal(id_site) {
    document.getElementById('modal-' + id_site).style.display = 'block';
}

// Close modal function
function closeModal(id_site) {
    document.getElementById('modal-' + id_site).style.display = 'none';
}

// Close modal when clicking outside of modal content
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
}


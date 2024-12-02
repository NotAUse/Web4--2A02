function saisie(){
    document.getElementById("addEventForm").addEventListener("submit", function (event) {
    // Prevent the form from submitting
    event.preventDefault();

    const errorMessage = document.getElementById("errorMessage");
    errorMessage.style.display = "none";
    errorMessage.textContent = "";

    const name = document.getElementById("Nom").value.trim();
    const description = document.getElementById("description").value.trim();
    const location = document.getElementById("localisation").value.trim();
    const category = document.getElementById("category").value.trim();
    const price = document.getElementById("price").value.trim();
    const contactInfo = document.getElementById("contact_info").value.trim();


    let isValid = true;

    // Validate fields
    if (!name || name.length < 3) {
        showError("Event name must be at least 3 characters long.");
        isValid = false;
    }

    if (!description || description.length < 10) {
        showError("Description must be at least 10 characters long.");
        isValid = false;
    }

    if (!location) {
        showError("Location cannot be empty.");
        isValid = false;
    }

    if (!category) {
        showError("You must select a category.");
        isValid = false;
    }

    if (!price || isNaN(price) || parseFloat(price) <= 0) {
        showError("Price must be a valid number greater than 0.");
        isValid = false;
    }

    if (!contactInfo || contactInfo.length < 5) {
        showError("Contact information must be at least 5 characters long.");
        isValid = false;
    }

    if(isValid){
    // If all validations pass, submit the form
        document.getElementById("clientValidated").value = "true";
        alert("Event added successfully!");
    }
    // Uncomment the line below to submit the form
    document.getElementById("eventForm").submit();
})};

function showError(message) {
    const errorMessage = document.getElementById("errorMessage");
    errorMessage.style.display = "block";
    errorMessage.textContent = message;
}


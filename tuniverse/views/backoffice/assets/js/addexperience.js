document.addEventListener("DOMContentLoaded", function() {

    var titreElement = document.getElementById("titre");
    var dateElement = document.getElementById("dateE");
    var noteElement = document.getElementById("noteE");
    
    titreElement.addEventListener("keyup", function() {
        var titreErrorElement = document.getElementById("titre_error");
        var titreErrorValue = titreElement.value.trim();
        var pattern = /^[A-Za-z\s]{3,}$/;
        
        
        if (!pattern.test(titreErrorValue)) {
            titreErrorElement.innerHTML = "Le titre doit contenir uniquement des lettres et des espaces et au moins 3 caractères"; 
            titreErrorElement.style.color = "red";
        } else {
            titreErrorElement.innerHTML = "Correct";
            titreErrorElement.style.color = "green";
        }
    });

    dateElement.addEventListener("change", function () {
        var dateErrorElement = document.getElementById("dateE_error");
        var dateValue = dateElement.value.trim();
        var currentDate = new Date().toISOString().split("T")[0];
    
        if (!/^\d{4}-\d{2}-\d{2}$/.test(dateValue)){
            dateErrorElement.innerHTML = "La date doit être au format AAAA-MM-JJ.";
            dateErrorElement.style.color = "red";
        } else if (dateValue < currentDate) {
            dateErrorElement.innerHTML = "La date doit être aujourd'hui ou une date future.";
            dateErrorElement.style.color = "red";
        } else {
            dateErrorElement.innerHTML = "Correct";
            dateErrorElement.style.color = "green";
        }
    });

    noteElement.addEventListener("keyup", function(){
        var noteErrorElement = document.getElementById("noteE_error");
        var noteErrorValue = noteElement.value.trim();
        var pattern = /^[0-5]{1}$/;
        
        if (!pattern.test(noteErrorValue)) {
            noteErrorElement.innerHTML = "La note doit être un chiffre compris entre 0 et 5";
            noteErrorElement.style.color = "red";
        } else {
            noteErrorElement.innerHTML = "Correct";
            noteErrorElement.style.color = "green";
        }
    });
});
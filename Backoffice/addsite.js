document.addEventListener("DOMContentLoaded", function() {

    var nomElement = document.getElementById("nom");
    var localisationElement = document.getElementById("localisation");
    var latitudeElement = document.getElementById("latitude");
    var longitudeElement = document.getElementById("longitude");
    
    nomElement.addEventListener("keyup", function() {
        var nomErrorElement = document.getElementById("nom_error");
        var nomErrorValue = nomElement.value.trim();
        var pattern = /^[A-Za-z\s]{3,}$/;
        
        
        if (!pattern.test(nomErrorValue)) {
            nomErrorElement.innerHTML = "Le nom doit contenir uniquement des lettres et des espaces et au moins 3 caractères"; 
            nomErrorElement.style.color = "red";
        } else {
            nomErrorElement.innerHTML = "Correct";
            nomErrorElement.style.color = "green";
        }
    });
    
    localisationElement.addEventListener("keyup", function() { 
        var localisationErrorElement = document.getElementById("localisation_error"); 
        var localisationErrorValue = localisationElement.value.trim(); 
        var pattern = /^[A-Za-z\s]{3,}$/;

       
        if (!pattern.test(localisationErrorValue)) {
            localisationErrorElement.innerHTML = "La localisation doit contenir uniquement des lettres et des espaces et au moins 3 caractères";
            localisationErrorElement.style.color = "red";
        } else {
            localisationErrorElement.innerHTML = "Correct";
            localisationErrorElement.style.color = "green";
        }
    });

    latitudeElement.addEventListener("keyup", function () {
        var latitudeErrorElement = document.getElementById("latitude_error");
        var latitudeErrorValue = latitudeElement.value.trim(); // Get input and remove extra spaces
        var pattern = /^[+-]?(?:90(?:\.0+)?|(?:[1-8]?\d)(\.\d+)?)$/;
    
        if (!pattern.test(latitudeErrorValue)) {
            latitudeErrorElement.innerHTML ="Veuillez entrer une latitude valide (entre -90 et 90)";
            latitudeErrorElement.style.color = "red";
        } else {
            latitudeErrorElement.innerHTML = "Correct";
            latitudeErrorElement.style.color = "green";
        }
    });

    longitudeElement.addEventListener("keyup", function () {
        var longitudeErrorElement = document.getElementById("longitude_error");
        var longitudeErrorValue = longitudeElement.value.trim(); // Get input and remove extra spaces
        var pattern = /^[+-]?(?:180(?:\.0+)?|(?:1[0-7]\d|\d{1,2})(\.\d+)?)$/;

        if (!pattern.test(longitudeErrorValue)) {
            longitudeErrorElement.innerHTML ="Veuillez entrer une longitude valide (entre -180 et 180)";
            longitudeErrorElement.style.color = "red";
        } else {
            longitudeErrorElement.innerHTML = "Correct";
            longitudeErrorElement.style.color = "green";
        }
    });
});




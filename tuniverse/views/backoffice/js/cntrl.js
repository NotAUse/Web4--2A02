
let currentPage = 1; 
const totalPages = 3; 
const pages = document.querySelectorAll('.page-item');
const content = document.getElementById('content');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

function updatePagination(page) {
    currentPage = page;

    // Update content
    content.textContent = `Content for Page ${page}`;

    // Enable/Disable buttons
    prevButton.classList.toggle('disabled', currentPage === 1);
    nextButton.classList.toggle('disabled', currentPage === pages.length - 2);

    // Highlight the current page
    pages.forEach((p, index) => {
        p.classList.toggle('active', index === page);
    });
}

pages.forEach((p, index) => {
    p.addEventListener('click', () => {
        if (index > 0 && index < pages.length - 1) {
            updatePagination(index);
        }
    });
});

prevButton.addEventListener('click', () => {
    if (currentPage > 1) updatePagination(currentPage - 1);
});

nextButton.addEventListener('click', () => {
    if (currentPage < pages.length - 2) updatePagination(currentPage + 1);
});

// Initialize
updatePagination(1);


document.addEventListener("DOMContentLoaded", function() {

  var titreElement = document.getElementById("Nom");
  var desElement = document.getElementById("description");
  var localElement = document.getElementById("localisation");
  var prixElement = document.getElementById("price");
  var CIElement = document.getElementById("contact_info");

  titreElement.addEventListener("keyup", function() {
      var titreErrorElement = document.getElementById("nomA");
      var titreErrorValue = titreElement.value.trim();
      var pattern = /^[A-Za-z\s]{3,}$/;


      if (!pattern.test(titreErrorValue)) {
          titreErrorElement.innerHTML = "Le nom doit contenir uniquement des lettres et des espaces et au moins 3 caractères"; 
          titreErrorElement.style.color = "red";
      } else {
          titreErrorElement.innerHTML = "Correct";
          titreErrorElement.style.color = "green";
      }
  });
  
    desElement.addEventListener("keyup", function() {
        var desErrorElement = document.getElementById("desA");
        var desErrorValue = desElement.value.trim();
        var pattern = /^[A-Za-z\s]{10,}$/;
  
  
        if (!pattern.test(desErrorValue)) {
            desErrorElement.innerHTML = "La description doit contenir uniquement des lettres et des espaces et au moins 10 caractères"; 
            desErrorElement.style.color = "red";
        } else {
            desErrorElement.innerHTML = "Correct";
            desErrorElement.style.color = "green";
        }
    });

    localElement.addEventListener("keyup", function() {
      var localErrorElement = document.getElementById("localA");
      var localErrorValue = localElement.value.trim();
      var pattern = /^[A-Za-z\s]{3,}$/;


      if (!pattern.test(localErrorValue)) {
          localErrorElement.innerHTML = "La localisation doit exist"; 
          localErrorElement.style.color = "red";
      } else {
          localErrorElement.innerHTML = "Correct";
          localErrorElement.style.color = "green";
      }
  });

  CIElement.addEventListener("keyup", function() {
    var CIErrorElement = document.getElementById("CI");
    var CIErrorValue = CIElement.value.trim();
    var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


    if (!pattern.test(CIErrorValue)) {
        CIErrorElement.innerHTML = "Faux"; 
        CIErrorElement.style.color = "red";
    } else {
        CIErrorElement.innerHTML = "Correct";
        CIErrorElement.style.color = "green";
    }
});


  prixElement.addEventListener("click", function(){
      var prixErrorElement = document.getElementById("prixA");
      var prixErrorValue = prixElement.value.trim();
      var pattern = /^[1-9][0-9]*$/;

      if (!pattern.test(prixErrorValue)) {
          prixErrorElement.innerHTML = "La prix doit être un chiffre compris entre 0 et 5";
          prixErrorElement.style.color = "red";
      } else {
          prixErrorElement.innerHTML = "Correct";
          prixErrorElement.style.color = "green";
      }
  });
});

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le profil utilisateur
    let userProfile = JSON.parse(localStorage.getItem('userProfile')) || {};

    // Éléments DOM
    const profilePic = document.getElementById('profilePic');
    const profileName = document.getElementById('profileName');
    const profileLocation = document.getElementById('profileLocation');
    const interestsList = document.getElementById('interestsList');
    const discoveriesList = document.getElementById('discoveriesList');
    const profilePicUpload = document.getElementById('profilePicUpload');
    const culturalPointsSpan = document.getElementById('culturalPoints');
    const visitedPlacesCountSpan = document.getElementById('visitedPlacesCount');

    // Modal de découverte
    const discoveryModal = document.getElementById('discoveryModal');
    const addDiscoveryBtn = document.getElementById('addDiscoveryBtn');
    const closeDiscoveryModalBtn = document.querySelector('.close-discovery');
    const discoveryForm = document.getElementById('discoveryForm');

    // Initialisation du profil
    function initializeProfile() {
        // Photo de profil
        if (userProfile.profilePicture) {
            profilePic.src = userProfile.profilePicture;
        }

        // Nom et ville
        profileName.textContent = userProfile.fullName || 'Utilisateur';
        profileLocation.textContent = userProfile.hometown || 'Ma ville';

        // Centres d'intérêt
        renderInterests();

        // Découvertes
        renderDiscoveries();

        // Statistiques
        culturalPointsSpan.textContent = userProfile.culturalPoints || 0;
        visitedPlacesCountSpan.textContent = userProfile.discoveries ? userProfile.discoveries.length : 0;
    }

    // Gestion des découvertes
    function renderDiscoveries() {
        discoveriesList.innerHTML = ''; // Vider la liste

        if (userProfile.discoveries && userProfile.discoveries.length > 0) {
            userProfile.discoveries.forEach(discovery => {
                const discoveryCard = createDiscoveryCard(discovery);
                discoveriesList.appendChild(discoveryCard);
            });
        }
    }

    function createDiscoveryCard(discovery) {
        const div = document.createElement('div');
        div.className = 'discovery-card';
        div.innerHTML = `
            <img src="${discovery.photo || 'default-discovery.jpg'}" alt="${discovery.name}">
            <div class="discovery-card-content">
                <h3>${discovery.name}</h3>
                <p>${discovery.description}</p>
                <p>Date de Visite: ${discovery.date}</p>
                <p>Type: ${discovery.type}</p>
            </div>
        `;
        return div;
    }

    // Événement pour ouvrir le modal de découverte
    addDiscoveryBtn.addEventListener('click', function() {
        discoveryModal.style.display = 'block';
    });

    // Fermer le modal de découverte
    closeDiscoveryModalBtn.addEventListener('click', function() {
        discoveryModal.style.display = 'none';
    });

    // Soumettre une nouvelle découverte
    discoveryForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Récupérer les valeurs du formulaire
        const discoveryName = document.getElementById('discoveryName').value;
        const discoveryDescription = document.getElementById('discoveryDescription').value;
        const discoveryDate = document.getElementById('discoveryDate').value;
        const discoveryType = document.getElementById('discoveryType').value;
        const discoveryPhotoInput = document.getElementById('discoveryPhoto');

        // Créer un objet découverte
        const newDiscovery = {
            name: discoveryName,
            description: discoveryDescription,
            date: discoveryDate,
            type: discoveryType,
            photo: null
        };

        // Gérer la photo de découverte
        if (discoveryPhotoInput.files.length > 0) {
            const reader = new FileReader();
            reader.onloadend = function() {
                newDiscovery.photo = reader.result;
                addDiscoveryToProfile(newDiscovery);
            };
            reader.readAsDataURL(discoveryPhotoInput.files[0]);
        } else {
            addDiscoveryToProfile(newDiscovery);
        }
    });

    // Ajouter la découverte au profil
    function addDiscoveryToProfile(discovery) {
        // Initialiser le tableau des découvertes s'il n'existe pas
        if (!userProfile.discoveries) {
            userProfile.discoveries = [];
        }

        // Ajouter la nouvelle découverte
        userProfile.discoveries.push(discovery);

        // Mettre à jour les points culturels
        userProfile.culturalPoints = (userProfile.culturalPoints || 0) + 10;

        // Sauvegarder le profil
        saveProfile();

        // Réinitialiser et fermer le modal
        discoveryForm.reset();
        discoveryModal.style.display = 'none';

        // Mettre à jour l'affichage
        renderDiscoveries();
        initializeProfile();
    }

    // Sauvegarder le profil dans le localStorage
    function saveProfile() {
        localStorage.setItem('userProfile', JSON.stringify(userProfile));
    }

    // Initialiser le profil à la charge de la page
    initializeProfile();

    // Gestion de la photo de profil
    profilePicUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePic.src = e.target.result;
                userProfile.profilePicture = e.target.result;
                saveProfile();
            };
            reader.readAsDataURL(file);
        }
    });

    // Gestion des centres d'intérêt (code précédent)
    function renderInterests() {
        interestsList.innerHTML = ''; // Vider la liste

        // Ajouter l'intérêt principal
        if (userProfile.mainInterest) {
            const mainInterestItem = createInterestItem(userProfile.mainInterest);
            interestsList.appendChild(mainInterestItem);
        }

        // Ajouter les intérêts supplémentaires
        if (userProfile.additionalInterests) {
            userProfile.additionalInterests.forEach(interest => {
                const interestItem = createInterestItem(interest);
                interestsList.appendChild(interestItem);
            });
        }
    }

    function createInterestItem(interest) {
        const li = document.createElement('li');
        li.innerHTML = `
            ${interest} 
            <button class="delete-interest-btn">✖️</button>
        `;
        
        const deleteBtn = li.querySelector('.delete-interest-btn');
        deleteBtn.addEventListener('click', function() {
            // Supprimer de la liste des intérêts
            if (interest === userProfile.mainInterest) {
                userProfile.mainInterest = null;
            } else {
                userProfile.additionalInterests = 
                    userProfile.additionalInterests.filter(i => i !== interest);
            }
            
            // Mettre à jour la liste des intérêts
            renderInterests();
            saveProfile();
        });

        return li;
    }

    // Gestion des modaux
    window.addEventListener('click', function(event) {
        if (event.target == discoveryModal) {
            discoveryModal.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le profil utilisateur
    let userProfile = JSON.parse(localStorage.getItem('userProfile')) || {};

    // Éléments DOM pour les centres d'intérêt
    const interestsList = document.getElementById('interestsList');
    const addInterestBtn = document.getElementById('addInterestBtn');
    const interestModal = document.getElementById('interestModal');
    const newInterestSelect = document.getElementById('newInterestSelect');
    const saveInterestBtn = document.getElementById('saveInterestBtn');
    const closeInterestModalBtn = interestModal.querySelector('.close');

    // Liste complète des intérêts disponibles
    const allInterests = [
        'Histoire', 'Culture', 'Artisanat', 'Gastronomie', 
        'Patrimoine', 'Architecture', 'Musique', 'Art', 
        'Traditions', 'Archéologie', 'Littérature'
    ];

    // Initialiser la liste des intérêts
    function renderInterests() {
        // Réinitialiser la liste des intérêts
        interestsList.innerHTML = '';

        // Fonction pour créer un élément d'intérêt
        function createInterestItem(interest) {
            const li = document.createElement('li');
            li.innerHTML = `
                ${interest} 
                <button class="delete-interest-btn">✖️</button>
            `;
            
            // Bouton de suppression
            const deleteBtn = li.querySelector('.delete-interest-btn');
            deleteBtn.addEventListener('click', function() {
                // Supprimer l'intérêt
                if (userProfile.additionalInterests) {
                    userProfile.additionalInterests = userProfile.additionalInterests.filter(i => i !== interest);
                    saveProfile();
                    renderInterests();
                }
            });

            return li;
        }

        // Ajouter l'intérêt principal s'il existe
        if (userProfile.mainInterest) {
            const mainInterestItem = createInterestItem(userProfile.mainInterest);
            interestsList.appendChild(mainInterestItem);
        }

        // Ajouter les intérêts supplémentaires
        if (userProfile.additionalInterests && userProfile.additionalInterests.length > 0) {
            userProfile.additionalInterests.forEach(interest => {
                const interestItem = createInterestItem(interest);
                interestsList.appendChild(interestItem);
            });
        }

        // Mettre à jour le sélecteur d'intérêts
        updateInterestSelector();
    }

    // Mettre à jour le sélecteur d'intérêts pour n'afficher que les intérêts non encore ajoutés
    function updateInterestSelector() {
        // Réinitialiser le sélecteur
        newInterestSelect.innerHTML = '<option value="">Choisissez un intérêt</option>';

        // Récupérer tous les intérêts déjà ajoutés
        const addedInterests = [
            userProfile.mainInterest, 
            ...(userProfile.additionalInterests || [])
        ].filter(Boolean);

        // Ajouter uniquement les intérêts non encore ajoutés
        allInterests
            .filter(interest => !addedInterests.includes(interest))
            .forEach(interest => {
                const option = document.createElement('option');
                option.value = interest;
                option.textContent = interest;
                newInterestSelect.appendChild(option);
            });
    }

    // Ouvrir le modal d'ajout d'intérêt
    addInterestBtn.addEventListener('click', function() {
        updateInterestSelector();
        interestModal.style.display = 'block';
    });

    // Fermer le modal
    closeInterestModalBtn.addEventListener('click', function() {
        interestModal.style.display = 'none';
    });

    // Sauvegarder un nouvel intérêt
    saveInterestBtn.addEventListener('click', function() {
        const newInterest = newInterestSelect.value;

        if (newInterest) {
            // Si pas d'intérêt principal, définir comme principal
            if (!userProfile.mainInterest) {
                userProfile.mainInterest = newInterest;
            } else {
                // Sinon, ajouter aux intérêts supplémentaires
                userProfile.additionalInterests = userProfile.additionalInterests || [];
                
                // Vérifier si l'intérêt n'existe pas déjà
                if (!userProfile.additionalInterests.includes(newInterest)) {
                    userProfile.additionalInterests.push(newInterest);
                }
            }

            // Sauvegarder et mettre à jour l'affichage
            saveProfile();
            renderInterests();
            
            // Fermer le modal
            interestModal.style.display = 'none';
        }
    });

    // Fonction de sauvegarde du profil
    function saveProfile() {
        localStorage.setItem('userProfile', JSON.stringify(userProfile));
    }

    // Initialiser l'affichage des intérêts
    renderInterests();

    // Fermer le modal si on clique en dehors
    window.addEventListener('click', function(event) {
        if (event.target == interestModal) {
            interestModal.style.display = 'none';
        }
    });
    
});

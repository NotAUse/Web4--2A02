<?php
include '../../controller/SiteController.php';
include '../../controller/ExperienceController.php';
$siteC = new siteController();
$expC = new ExperienceController();
$list = $siteC->listsite();
$lists=$expC->listexperience();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Célébration du Patrimoine Culturel Tunisien</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="../front web/js/profile.js"></script>
    <script src="../front web/js/script.js"></script>
    
        
</head>
<body>
    <header>
        <h1>Bienvenue sur Tuniverse</h1>
        <nav>
            <a href="#traditions">Traditions</a>
            <a href="#recits">Récits</a>
            <a href="#savoir-faire">Savoir-Faire</a>
            <a href="#meilleures-places">Meilleures Places</a>
            <a href="contact.php">Contact</a>
            <li><a href="signup.html">S'inscrire</a></li>
        </nav>
    </header>

    <main>
        <section id="traditions">
            <h2>Les Traditions</h2>
            <p>Découvrez la richesse des traditions tunisiennes.</p>
            <section id="traditions">
    <h2>Les Traditions Tunisiennes</h2>
    <p>Découvrez la richesse des traditions tunisiennes, un mélange fascinant de culture arabe, berbère et méditerranéenne.</p>

    <!-- Cuisine Section -->
    <h3>Cuisine Tunisienne</h3>
    <p>La cuisine tunisienne est variée et savoureuse. Ne manquez pas des plats comme le couscous, les bricks, et le tajine tunisien. Cliquez sur le plat pour en savoir plus !</p>
    
    <div class="food-gallery">
        <div class="food-item" onclick="openFoodModal('couscousModal')">
            <img src="../front web/img/couscous.webp" alt="Couscous ">
            <h4>Couscous</h4>
        </div>
        <div class="food-item" onclick="openFoodModal('brikModal')">
            <img src="../front web/img/brik.webp" alt="Brik">
            <h4>Brik</h4>
        </div>
    </div>

    <!-- Festivals Section -->
    <h3>Les Festivals Tunisiens</h3>
    <p>Les festivals tunisiens, comme le Festival de Carthage, mettent en avant la musique, le cinéma et les arts traditionnels.</p>
    
    <div class="festival-gallery">
        <div class="festival-item">
            <img src="../front web/img/carthage.jpg" alt="Festival de Carthage">
            <h4>Festival de Carthage</h4>
            <p>Un festival de musique et de cinéma qui attire des artistes internationaux et locaux.</p>
        </div>
        <div class="festival-item">
            <img src="../front web/img/djerba.webp" alt="Festival de Djerba">
            <h4>Festival de Djerba</h4>
            <p>Un événement culturel majeur célébrant les arts et la musique traditionnelle.</p>
        </div>
    </div>

    <!-- Music and Dance Section -->
    <h3>Musique et Danse Traditionnelles</h3>
    <p>La musique "Mezoued" et la danse "Raqs" sont des expressions culturelles vibrantes du patrimoine tunisien. Écoutez un extrait de musique Mezoued ci-dessous.</p>
    
    <audio controls>
        <source src="../front web/music/Mezwed Jaw Tunisie.mp3" type="audio/mp3">
        Votre navigateur ne prend pas en charge la lecture de fichiers audio.
    </audio>

    <!-- Arts and Crafts Section -->
    <h3>Arts et Artisanat</h3>
    <p>Les tapis, la poterie, et l'art de la broderie témoignent du savoir-faire unique des artisans tunisiens.</p>

    <div class="craft-gallery">
        <div class="craft-item">
            <img src="../front web/img/tapis traditionnel.jpg" alt="Tunisian Carpet">
            <h4>Tapis Traditionnels</h4>
        </div>
        <div class="craft-item">
            <img src="../front web/img/poterie tunisien.jpg" alt="Tunisian Ceramics">
            <h4>Poterie Tunisienne</h4>
        </div>
    </div>
</section>

<!-- Modal for Food Details -->
<div id="couscousModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeFoodModal('couscousModal')">&times;</span>
        <h2>Recette du Couscous Tunisien</h2>
        <p>Le couscous tunisien est préparé avec de la semoule fine et servi avec de la viande (agneau ou poulet), des légumes et des épices.</p>
        <img src="../front web/img/couscous-tunisien.jpeg" alt="Couscous">
        <p><strong>Ingrédients:</strong> Semoule, viande, légumes, épices (ras el hanout), pois chiches.</p>
    </div>
</div>

<!-- Modal for Brik Details -->
<div id="brikModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeFoodModal('brikModal')">&times;</span>
        <h2>Recette du Brik Tunisien</h2>
        <p>Le Brik est un plat composé de pâte fine farcie souvent avec un œuf, puis frit. C'est un incontournable lors des repas.</p>
        <img src="../front web/img/brik.webp" alt="Brik">
        <p><strong>Ingrédients:</strong> Pâte filo, œuf, thon, câpres.</p>
    </div>
</div>

        </section>

        <section id="recits">
            <h2>Récits Culturels</h2>
            <p>Explorez les récits qui forment notre identité collective.</p>
        </section>

        <section id="savoir-faire">
            <h2>Savoir-Faire</h2>
            <p>Connectez-vous avec les savoir-faire tunisiens.</p>
        </section>

        <section id="meilleures-places">
            <h2>Les Meilleures Places à Visiter en Tunisie</h2>
            <!-- Barre de recherche -->
            <input type="text" id="searchInput" onkeyup="filterPlaces()" placeholder="Rechercher un lieu..." />
            <div class="places-container" id="placesContainer">
                <?php 
                foreach ($list as $site) { 
                    // Fetch experiences for the current site
                    $experiences = $expC->showExperienceBySite($site['id_site']);
                ?>
                    <div class="place">
                        <h3>Nom du site: </h3>
                        <p><?php echo $site['nom']; ?></p>
                        
                        <h3>Localisation du site: </h3>
                        <p><?php echo $site['localisation']; ?></p>

                        <?php if (!empty($site['images'])): ?>
                        <img src="<?php echo $site['images']; ?>" alt="<?php echo $site['nom']; ?>" />
                        <?php else: ?>
                            <p>No image available</p>
                        <?php endif; ?>
                        
                        <h3>Description du site culturel:</h3>
                        <p><?php echo $site['descriptions']; ?></p>
                        
                        <!-- Display experiences for this site -->
                        <div class="experiences">
                            <h4>Expériences liées au site:</h4>
                            <?php if (!empty($experiences)) { ?>
                                <?php foreach ($experiences as $experience) { ?>
                                     <strong>Titre:</strong> <?php echo $experience['titre']; ?><br>
                                     <strong>Description:</strong> <?php echo $experience['descriptionE']; ?><br>
                                     <strong>Date:</strong> <?php echo $experience['dateE']; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <p>Aucune expérience n'est associée à ce site pour le moment.</p>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
    
    <button onclick="scrollToTop()" id="backToTop" title="Back to Top">↑</button>
    <script src="script.js"></script>
</body>
</html>
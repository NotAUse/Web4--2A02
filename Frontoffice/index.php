<?php
include '../../controller/SiteController.php';
include '../../controller/ExperienceController.php';
$siteC = new siteController();
$expC = new ExperienceController();
$list = $siteC->listsite();
$sitesJson = json_encode($list);

if (isset($_GET['nom'])) {
    $nom = $_GET['nom'] ?? null;
    $list = $siteC->searchSites(null,$nom,null,null);
  } else {
    $list = $siteC->listsite();
  }

$sitesParPage = 6;
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($pageActuelle - 1) * $sitesParPage;
$totalSites = count($list);
$totalPages = ceil($totalSites / $sitesParPage);
$sites = array_slice($list, $startIndex, $sitesParPage);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Célébration du Patrimoine Culturel Tunisien</title>
    <link rel="stylesheet" href="../frontoffice/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="../front web/js/profile.js"></script>
    <script src="../front web/js/script.js"></script>
    <title>Carte Mapbox - Tunisie</title>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css" rel="stylesheet" />
    <style>
        body { margin: 0; padding: 0; }
        #map { height: 100vh; }
    </style>
    <!-- Fonts and icons -->
    <script src="../backoffice/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../backoffice/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    
        
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
            <div class="search-bar" id="searchInput" style="display: flex; align-items: center;">
                <form method="GET" action="" style="display: flex; align-items: center; gap: 8px;">
                    <input 
                        type="text" 
                        name="nom" 
                        placeholder="Rechercher un Nom" 
                        value="<?= isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : '' ?>" 
                        style="width: 200px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                    <button 
                        type="submit" 
                        class="btn btn-primary" 
                        style="padding: 5px 10px; font-size: 12px; width: auto; flex-shrink: 0;">
                        Rechercher
                    </button>
                </form>
            </div>

            <div class="places-container" id="placesContainer">
                <?php 
                foreach ($sites as $site) { 
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
                        <form method="POST" action="addexperience.php" style="display: inline;" >
                            <input type="hidden" value="<?php echo $site['id_site']; ?>" name="id_site">
                            <input type="hidden" value="<?php echo $site['nom']; ?>" name="nom_site">
                            <button type="submit" name="addexperience" class="btn btn-primary">ajouter votre experience</button>
                        </form>
                        <form method="GET" action="viewexperience.php" style="display: inline;">
                            <input type="hidden" value="<?php echo $site['id_site']; ?>" name="id_site">
                            <button type="submit" class="btn btn-primary">Voir les expériences</button>
                        </form>
                    </div>
                <?php } ?>
            </div>

            <div class="pagination">
                <?php if ($pageActuelle > 1): ?>
                    <a href="?page=<?php echo $pageActuelle - 1; ?>">Précédent</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" 
                    class="<?php echo ($i === $pageActuelle) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pageActuelle < $totalPages): ?>
                    <a href="?page=<?php echo $pageActuelle + 1; ?>">Suivant</a>
                <?php endif; ?>
            </div>
            
            <h2>Map contenant les sites culturels</h2>
            <div id="map"></div>
                 <script>
                     mapboxgl.accessToken = 'pk.eyJ1IjoiYXlvdWJqZW1hbGkiLCJhIjoiY20zd3M0c3o3MTRiejJpcjB6NHlvdTF5NyJ9.yALYB_t3BCXigiJ4nsMYRA';
                     var map = new mapboxgl.Map({
                         container: 'map',
                         style: 'mapbox://styles/mapbox/streets-v11',
                         center: [9.0, 33.8869], 
                         zoom: 6 
                     });

                     var sites = <?php echo $sitesJson; ?>;

                   sites.forEach(function(site) {
                       new mapboxgl.Marker()
                           .setLngLat([site.longitude, site.latitude]) 
                           .setPopup(new mapboxgl.Popup().setHTML('<h3>' + site.nom + '</h3><p>' + site.descriptions + '</p>'))
                           .addTo(map);
                   });
                 </script>
        </section>
        
    </main>
    <style>
    .pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    }

    .pagination a {
        margin: 0 5px;
        padding: 8px 16px;
        text-decoration: none;
        background-color: #e0f7e0;  
        color: #2c6b2f;  
        border: 1px solid #b3e0b3;  
        border-radius: 5px;
    }

    .pagination a.active {
        background-color: #28a745;  
        color: #fff;  
        border: 1px solid #218838;  
    }

    .pagination a:hover {
        background-color: #a1e6a1;  
    }
    form {
        margin-right: 10px;
    }

    .btn {
        margin-top: 2px; 
    }

    </style>
    <button onclick="scrollToTop()" id="backToTop" title="Back to Top">↑</button>
    <script src="script.js"></script>
</body>
</html>
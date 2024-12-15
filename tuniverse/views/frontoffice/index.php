<?php
include '../../controllers/SiteController.php';
include '../../controllers/ExperienceController.php';
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
<?php
// Connexion à la base de données
require_once "../../Controllers/connexion.php";

try {
    // Configuration de la pagination
    $recipesPerPage = 3; // Nombre de recettes par page
    $currentPageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($currentPageNumber < 1) $currentPageNumber = 1;

    $offset = ($currentPageNumber - 1) * $recipesPerPage;

    // Vérifier si une recherche est effectuée
    $searchQuery = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : null;

    if ($searchQuery) {
        // Requête SQL pour chercher par nom de recette ou ingrédient
        $sql = "
            SELECT DISTINCT r.* 
            FROM recette r
            LEFT JOIN recipe_ingredient ri ON r.id_recette = ri.recette_id
            LEFT JOIN ingredient i ON ri.ingredient_id = i.ID_ingredient
            WHERE r.Nom LIKE :searchQuery OR i.nom LIKE :searchQuery
            LIMIT :offset, :recipesPerPage
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
    } else {
        // Requête SQL sans filtre de recherche
        $sql = "SELECT * FROM recette LIMIT :offset, :recipesPerPage";
        $stmt = $conn->prepare($sql);
    }

    // Ajouter les paramètres pour la pagination
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':recipesPerPage', $recipesPerPage, PDO::PARAM_INT);
    $stmt->execute();

    // Requête pour compter le nombre total de résultats
    $countQuery = $searchQuery
        ? "
            SELECT COUNT(DISTINCT r.id_recette) 
            FROM recette r
            LEFT JOIN recipe_ingredient ri ON r.id_recette = ri.recette_id
            LEFT JOIN ingredient i ON ri.ingredient_id = i.ID_ingredient
            WHERE r.Nom LIKE :searchQuery OR i.nom LIKE :searchQuery
        "
        : "SELECT COUNT(*) FROM recette";
    $countStmt = $conn->prepare($countQuery);

    if ($searchQuery) {
        $countStmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
    }
    $countStmt->execute();
    $totalRecipes = $countStmt->fetchColumn();
    $totalPages = ceil($totalRecipes / $recipesPerPage);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Célébration du Patrimoine Culturel Tunisien</title>
    <link rel="stylesheet" href="../frontoffice/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="../frontoffice/js/profile.js"></script>
    <script src="../frontoffice/js/script.js"></script>
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
            <a href="#savoir-faire">Events</a>
            <li><a href="signup.php">S'inscrire</a></li>
            <li><a href="login.php">login</a></li>
            <a href="profile.html" class="my-account-link">
                <i class="fas fa-user-circle user-icon"></i>
                Mon Compte
            </a>
        </nav>
    </header>

    <main>
        
            
            <section id="traditions">
    <h2>Les Traditions Tunisiennes</h2>
    <p>Découvrez la richesse des traditions tunisiennes, un mélange fascinant de culture arabe, berbère et méditerranéenne.</p>

    <!-- Cuisine Section -->
    <h3>Cuisine Tunisienne</h3>
    <p>La cuisine tunisienne est variée et savoureuse. Ne manquez pas des plats comme le couscous, les bricks, et le tajine tunisien. Cliquez sur le plat pour en savoir plus !</p>
    
    <section id="search">
            <h2>Recherche de Recettes</h2>
            <form action="" method="GET">
                <input type="text" name="query"  width="10%"  placeholder="Saisissez le nom de la recette..." value="<?= isset($searchQuery) ? htmlspecialchars($searchQuery) : '' ?>">
                <button type="submit">Rechercher</button>
            </form>
        </section>

        <section id="traditions">
            <h2>Les Recettes</h2>
            <p>Découvrez la richesse des traditions culinaires tunisiennes.</p>
            <div class="recipe-list">
                <?php
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row['id_recette'];
                        $nom = htmlspecialchars($row['Nom']);
                        $description = htmlspecialchars($row['description']);
                        $audioPath = !empty($row['audio']) && file_exists($row['audio']) ? htmlspecialchars($row['audio']) : null;
                        $imagePath = !empty($row['image']) && file_exists($row['image']) ? htmlspecialchars($row['image']) : 'default_image.jpg';


                        echo '
                        <div class="recipe-card">
                                <img src="' . $imagePath . '" width="100" height="100" alt="' . $nom . '">
                            
                            <h3>' . $nom . '</h3>
                            <p>' . substr($description, 0, 100) . '...</p>
                           
                            <a href="recipe_details.php?recette_id=' . $id . '" class="btn ">Voir les Détails</a>
                        </div>';
                    }
                } else {
                    echo '<p>Aucune recette trouvée.</p>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <nav class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <div class="<?= $i == $currentPageNumber ? 'active' : '' ?>">
                            <a href="?page=<?= $i ?>&query=<?= isset($searchQuery) ? urlencode($searchQuery) : '' ?>"><?= $i ?></a>
                        </div>
                    <?php endfor; ?>
                </nav>
            <?php endif; ?>
        </section>
</section>



        <section id="recits">
            <div class="main-container">
            <h2>Boîte à Histoire</h2>
                <div class="histoire-container">
                    <div class="histoire">
                        <h2>Le secret de l'étreinte</h2>
                        <p>Un secret longtemps gardé...</p>
                        <img src="kairouan.jpg" alt="Image du secret de l'étreinte"><br>
                        <a href="../../views/backoffice/incremente_vue.php?id=20">Lire plus</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="savoir-faire">
        <h2>Upcoming Events</h2>
            <div class="places-container">
                <?php
                require_once '../../config/config.php'; 

                try {
                    $pdo = config::getConnexion();
                    
                    $sql = "SELECT * FROM events";
                    $stmt = $pdo->query($sql);
                
                    if ($stmt->rowCount() > 0) {
                        echo '<div class="container">';
                        echo '<div class="row">';
                
                        foreach ($stmt as $row) {
                            echo '
                            <div class="col-md-20 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                    <img src='.htmlspecialchars($row['images']).' width="120px" height="70px">
                                    <h2>' . htmlspecialchars($row['Nom']) . '</h2>
                                    </div>
                                    <div class="card-body">
                                        
                                        <p><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>
                                        <p><strong>Location:</strong> ' . htmlspecialchars($row['localisation']) . '</p>
                                        <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                                        <p><strong>Price:</strong> ' . htmlspecialchars($row['price']) . ' TND</p>
                                        <p><strong>Contact Info:</strong> ' . htmlspecialchars($row['contact_info']) . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<p>No events found.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Error fetching events: ' . $e->getMessage();
                }
                
                ?>    
                
            </div>
            <h3>Event Name</h3>
            <p>Event Details</p>
            <button class="btn btn-primary join-event" data-event-id="1">
                Join Event
            </button>
            <div id="participation-info-1" class="mt-4">
                <!-- Participation details will load here -->
            </div>
            <?php
              require_once '../../config/config.php';
              
              function getParticipationByEvent($id_event) {
                  $pdo = config::getConnexion();
                  $stmt = $pdo->prepare("SELECT * FROM participants WHERE id_event = :id_event");
                  $stmt->bindParam(':id_event', $id_event);
                  $stmt->execute();
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
              }

              // Add Participation
              function addParticipation($id_user, $id_event, $date_part, $nbr_ticket, $payed) {
                  $pdo = config::getConnexion();
                  $stmt = $pdo->prepare("
                      INSERT INTO participants (id_user, id_event, date_part, nbr_ticket, payed)
                      VALUES (:id_user, :id_event, :date_part, :nbr_ticket, :payed)
                  ");
                  $stmt->bindParam(':id_user', $id_user);
                  $stmt->bindParam(':id_event', $id_event);
                  $stmt->bindParam(':date_part', $date_part);
                  $stmt->bindParam(':nbr_ticket', $nbr_ticket);
                  $stmt->bindParam(':payed', $payed);
                  $stmt->execute();
                  return $pdo->lastInsertId();
              }

              $eventId = 1; 
              $participations = getParticipationByEvent($eventId);

              // 2. Add a participation record
              $newParticipation = addParticipation(123, 1, date('Y-m-d'), 2, 1); // Replace with dynamic values
              ?>
              
                
            <script>
                document.querySelectorAll(".join-event").forEach(button => {
                button.addEventListener("click", () => {
                    const eventId = button.getAttribute("data-event-id");
                    const userId = 123;
                    const tickets = 1; 

                    fetch("../../controler/particip.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id_user: userId,
                        id_event: eventId,
                        nbr_ticket: tickets,
                        payed: 1 
                    })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                        document.getElementById(`participation-info-${eventId}`).innerHTML =
                            `<p>Successfully joined the event! Tickets: ${tickets}</p>`;
                        } else {
                        alert("Failed to join the event. Please try again.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
                });
                </script>
                <script>
                    function highlightEvent(element) {
                        console.log("Event clicked:", element); // Debugging
                        document.querySelectorAll('.event-box').forEach(box => {
                            box.classList.remove('selected');
                        });
                        element.classList.add('selected');
                    }
                </script>

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-lg">
              <li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li> 
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
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
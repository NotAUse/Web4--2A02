<html lang="fr"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Célébration du Patrimoine Culturel Tunisien</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <style> /* General styles for the section */

* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Style général de la page */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fafafa;
            padding: 20px;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #333;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        nav a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 1.1em;
        }

        nav a:hover {
            color: #0056b3;
        }

        /* Section de recherche */
        #search {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 40px;
        }

        #search h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #333;
        }

        /* Formulaire de recherche */
        .search-form {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espacement entre l'input et le bouton */
            width: 100%;
            max-width: 600px;
        }

        /* Input de recherche */
        .search-form input {
            padding: 10px;
            font-size: 16px;
            width: calc(100% - 120px); /* Prendre toute la place sauf la largeur du bouton */
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        /* Bouton de recherche */
        .search-form button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        /* Section des recettes */
        #traditions {
            padding: 40px 20px;
            text-align: center;
            background-color: #f7f7f7;
            margin-bottom: 40px;
        }

        #traditions h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #333;
        }

        .recipe-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Grid responsive */
            gap: 20px;
            justify-items: center;
            padding: 20px;
        }

        .recipe-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 280px;
            width: 100%;
            border: 2px solid #ddd;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .recipe-card h3 {
            font-size: 1.3em;
            margin-bottom: 10px;
            color: #333;
        }

        .recipe-card p {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 15px;
        }

        .recipe-card .btn-info {
            background-color: #17a2b8;
            color: #fff;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .recipe-card .btn-info:hover {
            background-color: #138496;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

   
</style>
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
    <section id="search">
            <h2>Recherche de Recettes</h2>
            
            <form action="" method="GET">
                <input type="text" name="query" placeholder="Saisissez le nom de la recette..." >
                <button type="submit">Rechercher</button>
            </form>
        </section>



    <section id="traditions">
    <h2>Les Recettes</h2>
    <p>Découvrez la richesse des traditions culinaires tunisiennes.</p>
    <div class="recipe-list">
        <?php
        require_once "../../Controller/connexion.php";
       
        try {
              // Configuration de la pagination
             $recipesPerPage = 10; // Nombre de recettes par page
             $currentPageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
             $offset = ($currentPageNumber - 1) * $recipesPerPage;

            
            if (isset($_GET['query']) && !empty($_GET['query'])) {
                $searchQuery = htmlspecialchars($_GET['query']);
                $sql = "SELECT * FROM recette WHERE Nom LIKE :searchQuery";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindParam(':recipesPerPage', $recipesPerPage, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $sql = "SELECT * FROM recette LIMIT :offset, :recipesPerPage";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindParam(':recipesPerPage', $recipesPerPage, PDO::PARAM_INT);
                $stmt->execute();
        

            }
  // Calculer le nombre total de pages
                $countQuery = isset($searchQuery) 
                ? "SELECT COUNT(*) FROM recette WHERE Nom LIKE :searchQuery" 
                : "SELECT COUNT(*) FROM recette";
                $countStmt = $conn->prepare($countQuery);
                if (isset($searchQuery)) {
                $countStmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
                }
                $countStmt->execute();
                $totalRecipes = $countStmt->fetchColumn();
                $totalPages = ceil($totalRecipes / $recipesPerPage);
                } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                }
                ?>

<div class="recipe-list">
<?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id_recette'];
                    $nom = htmlspecialchars($row['Nom']);
                    $description = htmlspecialchars($row['description']);
                    echo '
                    <div class="recipe-card">
                    <img src="couscous.jpg" width="100" height="100">
                        <h3>' . $nom . '</h3>
                        <p>' . substr($description, 0, 100) . '...</p>
                        <a href="recipe_details.php?recette_id=' . $id . '" class="btn btn-info">Voir les Détails</a>
                    </div>';
                    
                }
            } else {
                echo '<p>Aucune recette trouvée.</p>';
            }
        
        ?>
    </div>
    <!-- Pagination -->
<?php if ($totalPages > 1): ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $currentPageNumber ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&category=<?= $selectedCategory ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
</section>



<!-- Modal for Food Details -->
<div id="couscousModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeFoodModal('couscousModal')">×</span>
        <h2>Recette du Couscous Tunisien</h2>
        <p>Le couscous tunisien est préparé avec de la semoule fine et servi avec de la viande (agneau ou poulet), des légumes et des épices.</p>
        <img src="Couscous.jpg" alt="Couscous">
        <p><strong>Ingrédients:</strong> 62.5g de Semoule, viande,1/2 c.à.s de concentrée de tomates,0.5 pomme de terre,0.5 piment vert,poudre de piment rouge ,sel ou sel fin,0.5 oignon,0.5 carotte,1/2 verre d'huile d'olive ,Mélange d'épices (tunisien),poivre, pois chiches.</p>
        <strong>préparation(5omin):</strong>
        <ol>
            <li>Émincer finement l'oignon.</li>
            <li>Le faire revenir dans de l'huile d'olive dans le fond du couscoussier ou le fond d'une cocotte basique.</li>
            <li>Une fois coloré, ajouter la viande coupée en morceaux.</li>
            <li>Faire dorer</li>
            <li>Ajouter deux grosses cuillères à soupe de concentré de tomate.</li>
            <li>Faire dessécher légèrement le concentré.</li>
            <li>Ajouter 4 verres d'eau.</li>
            <li>Découper les carottes dans la longueur.</li>
            <li>Découper les pommes de terre en 4.</li>
            <li>Ajouter les carottes, les pommes de terre et les piments dans la cocotte ou le couscoussier.</li>
            <li>Remuer le tout.</li>
            <li>Recouvrir d'eau à hauteur.</li>
            <li>Ajouter les épices puis Remuer bien à nouveau.</li>
            <li>Saler et poivrer à convenance et baisser le feu à moyen.</li>
            <li>Laisser cuire 1h jusqu'à ce que la viande se détache et que les légumes soient bien cuits.Pendant ce temps, mettre la semoule dans un grand plat.</li>
            <li>La mouiller de 2 grands verres d'huile d'olive.L'égrener à la fourchette ou à la main jusqu'à ce qu'elle soit bien séparée. Mettre la semoule dans le haut du couscoussier.</li>
            <li>Faire cuire 30 min en remuant de temps à autre puis Sortir la semouleet la mouiller avec de l'eau.</li>
            <li>Bien mélanger pour que les grains ne collent pas.Remettre sur le couscoussier.En fin de cuisson de la semoule, ajouter environ 2 louches de la sauce du couscous (sans légumes)</li>
            <li>Dresser la semoule en rond en laissant un puit au milieu.Y dresser la sauce.</li>
            <li>Disposer les carottes en 'soleil' avec les pommes de terre.</li>
        
        </ol>

    </div>
</div>

<!-- Modal for Brik Details -->
<div id="brikModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeFoodModal('brikModal')">×</span>
        <h2>Recette du Brik Tunisien</h2>
        <p>Le Brik est un plat composé de pâte fine farcie souvent avec un œuf, puis frit. C'est un incontournable lors des repas.</p>
        <img src="brik1.jpeg" alt="Brik">
        <p><strong>Ingrédients:</strong> Pâte filo, œuf, thon, câpres.</p>
    </div>
</div>

        </section>

        

        

        
    </main>

    <!-- Modals -->
    

    

    

    

    

    
    
    <button onclick="scrollToTop()" id="backToTop" title="Back to Top" style="display: none;">↑</button>
    <script src="script.js"></script>

</body></html>

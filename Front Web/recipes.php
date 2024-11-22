<html lang="fr"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuniverse - Célébration du Patrimoine Culturel Tunisien</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet">
    <style> /* General styles for the section */
#traditions {
    padding: 40px 20px; /* Add padding on the sides for the section */
    text-align: center;
    background-color: #f7f7f7;
}

/* Styling the recipe cards with bubble or cube-like effects */
.recipe-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Smaller card size */
    gap: 20px; /* Add space between the cards */
    justify-items: center;
    padding: 20px;
}

.recipe-card {
    background-color: #fff;
    border-radius: 20px; /* For a bubble effect */
    padding: 20px; /* Smaller padding for the cards */
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
    max-width: 280px; /* Set a maximum width for the smaller cards */
    border: 2px solid #ddd;
    margin: 0; /* Ensure no margin between the cards */
}

.recipe-card:hover {
    transform: translateY(-5px); /* Slight lift on hover */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

/* Styling the recipe title and description */
.recipe-card h3 {
    font-size: 1.3em; /* Smaller font size */
    margin-bottom: 10px;
    color: #333;
}

.recipe-card p {
    font-size: 0.9em; /* Smaller font size for description */
    color: #555;
    margin-bottom: 15px;
}

/* Styling the 'Voir les Détails' button */
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
    <section id="traditions">
    <h2>Les Recettes</h2>
    <p>Découvrez la richesse des traditions culinaires tunisiennes.</p>
    <div class="recipe-list">
        <?php
        require_once "../../Controller/connexion.php";

        try {
            $sql = "SELECT * FROM recette";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id_recette'];
                    $nom = htmlspecialchars($row['Nom']);
                    $description = htmlspecialchars($row['description']);
                    echo '
                    <div class="recipe-card">
                        <h3>' . $nom . '</h3>
                        <p>' . substr($description, 0, 100) . '...</p>
                        <a href="recipe_details.php?recette_id=' . $id . '" class="btn btn-info">Voir les Détails</a>
                    </div>';
                }
            } else {
                echo '<p>Aucune recette trouvée.</p>';
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        ?>
    </div>
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

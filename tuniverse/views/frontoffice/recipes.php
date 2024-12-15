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
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fafafa;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 40px;
        }
        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #333;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }
        .recipe-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
            padding: 20px;
        }
        .recipe-card {
            background-color: #fff;
            border-radius: 30px;
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
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin: 20px 0;
        }
        .pagination a {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .pagination .active a {
            background: #0056b3;
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
        </nav>
    </header>
    <main>
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
    </main>
</body>
</html>

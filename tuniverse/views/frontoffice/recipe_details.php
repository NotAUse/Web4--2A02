recipe detail:<?php
require_once "../../Controllers/connexion.php";

$recette_id = $_GET['recette_id'] ?? null;

if (!$recette_id) {
    echo "<p>Erreur : ID de la recette manquant !</p>";
    exit;
}

try {
    // Fetch recipe details
    $sql_recipe = "SELECT * FROM recette WHERE id_recette = :recette_id";
    $stmt_recipe = $conn->prepare($sql_recipe);
    $stmt_recipe->bindParam(':recette_id', $recette_id, PDO::PARAM_INT);
    $stmt_recipe->execute();
    $recipe = $stmt_recipe->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        echo "<p>Erreur : Recette introuvable !</p>";
        exit;
    }

    // Fetch associated ingredients
    $sql_ingredients = "
        SELECT i.nom AS ingredient_name, ri.quantity 
        FROM recipe_ingredient ri
        JOIN ingredient i ON ri.ingredient_id = i.ID_ingredient
        WHERE ri.recette_id = :recette_id
    ";
    $stmt_ingredients = $conn->prepare($sql_ingredients);
    $stmt_ingredients->bindParam(':recette_id', $recette_id, PDO::PARAM_INT);
    $stmt_ingredients->execute();
    $ingredients = $stmt_ingredients->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Recette</title>
    <link rel="stylesheet" href="style.css">
    <style>/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Font Setup */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Header Styling */
header {
    background-color: #17a2b8;
    color: white;
    text-align: center;
    padding: 20px;
}

header h1 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

/* Main Content Styling */
main {
    padding: 30px;
    max-width: 900px;
    margin: 30px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 2em;
    color: #17a2b8;
    margin-bottom: 20px;
}

h3 {
    font-size: 1.5em;
    margin-top: 20px;
    color: #333;
}

/* Description and Ingredients */
p {
    font-size: 1.1em;
    margin-bottom: 15px;
}

ul {
    list-style-type: none;
    padding-left: 0;
    font-size: 1.1em;
}

ul li {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

ul li:last-child {
    border-bottom: none;
}

/* Audio Section */
audio {
    margin-top: 10px;
    width: 100%;
    border: none;
    outline: none;
}

/* Button Styling */
.btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 30px;
    background-color: #17a2b8;
    color: white;
    font-weight: bold;
    border-radius: 25px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #138496;
}

/* Responsive Styling */
@media screen and (max-width: 768px) {
    main {
        padding: 20px;
    }

    h2 {
        font-size: 1.8em;
    }

    h3 {
        font-size: 1.3em;
    }

    p, ul li {
        font-size: 1em;
    }

    .btn {
        padding: 8px 18px;
    }
}
</style>
</head>
<body>
    <header>
        <h1>Détails de la Recette</h1>
    </header>
    <main>
    <h2><?php echo htmlspecialchars($recipe['Nom']); ?></h2>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe['description']); ?></p>
    <p><strong>Catégorie:</strong> <?php echo htmlspecialchars($recipe['categorie']); ?></p>



    <h3>Image</h3>
<?php 
// Supposons que $recipe['image_path'] contient le nom de l'image, par exemple 'couscous.jpg'
$imageFile = !empty($recipe['image_path']) ? htmlspecialchars($recipe['image']) : null;

// Vérifier si l'image de la recette existe
if ($imageFile && file_exists('frontoffice/' . $imageFile)) {
    // Si l'image de la recette existe
    echo '<img src="frontoffice/' . $imageFile . '" alt="Image de la recette">';
} else {
    // Si l'image de la recette n'existe pas, afficher un message d'erreur
    echo '<p class="error-message">L\'image de la recette n\'est pas disponible.</p>';
}
?>

    <h3>Audio</h3>
    
<?php if (!empty($recipe['audio'])) : ?>
    <p>Audio file path: <strong>../<?php echo htmlspecialchars($recipe['audio']); ?></strong></p> <!-- Debugging line -->
    <audio controls>
        <source src="frontoffice/<?php echo htmlspecialchars($recipe['audio']); ?>" type="audio/mpeg">
        Votre navigateur ne supporte pas la lecture audio.
    </audio>
<?php else: ?>
    <p>Aucun fichier audio disponible.</p>
    
<?php endif; ?>





    <h3>Ingrédients</h3>
    <?php if (count($ingredients) > 0): ?>
        <ul>
            <?php foreach ($ingredients as $ingredient): ?>
                <li>
                    <?php echo htmlspecialchars($ingredient['ingredient_name']); ?> - 
                    <?php echo htmlspecialchars($ingredient['quantity']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun ingrédient trouvé pour cette recette.</p>
    <?php endif; ?>
    

    <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
    <a href="generate_pdf.php?recette_id=<?= $recette_id ?>" class="btn">Télécharger en PDF</a>
</main>

</body>
</html>
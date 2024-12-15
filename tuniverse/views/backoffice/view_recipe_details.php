<?php
require_once "../../Controllers/connexion.php";

$recette_id = $_GET['recette_id'] ?? null;

if (!$recette_id) {
    echo "<p>Error: Recipe ID not provided!</p>";
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
        echo "<p>Error: Recipe not found!</p>";
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
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <style>
        /* Add background image and ensure full screen */
        body {
            margin: 0;
            padding: 0;
            background-image: url('https://t3.ftcdn.net/jpg/01/79/59/92/360_F_179599293_7mePKnajSM4bggDa8NkKpcAHKl3pow2l.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        /* Center the content */
        .content {
            background-color: rgba(0, 0, 0, 0.6); /* Dark background with opacity */
            padding: 30px;
            border-radius: 10px;
            max-width: 800px;
            width: 100%;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h2, h3 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        a {
            color: #f0f0f0;
            text-decoration: none;
            font-size: 1.1em;
            margin-top: 20px;
            display: inline-block;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 5px;
        }

        a:hover {
            background-color: #555;
        }

        ul {
            text-align: left;
            font-size: 1.1em;
            margin-top: 20px;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Recipe Details</h2>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($recipe['id_recette']); ?></p>
        <p><strong>Nom:</strong> <?php echo htmlspecialchars($recipe['Nom']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($recipe['description']); ?></p>
        <p><strong>Audio:</strong> <?php echo htmlspecialchars($recipe['audio']); ?></p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($recipe['categorie']); ?></p>

        <p><strong>image:</strong> <?php echo htmlspecialchars($recipe['image']); ?></p>

        <h3>Ingredients</h3>
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
            <p>No ingredients found for this recipe.</p>
        <?php endif; ?>

        <a href="javascript:history.back()">Go Back</a>
    </div>
</body>
</html>

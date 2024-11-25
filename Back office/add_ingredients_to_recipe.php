<?php
require_once "../../Controller/connexion.php";

// Get the recipe ID from the URL
$recette_id = $_GET['recette_id'] ?? null;

if (!$recette_id) {
    echo "<p>Error: Recipe ID not provided!</p>";
    exit;
}

// Fetch all ingredients to populate the dropdown
try {
    $sql = "SELECT * FROM ingredient";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Ingredients</title>
    <style>/* General Reset and Body Setup */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Center the form and give it some padding */
form {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Heading Styling */
h2 {
    text-align: center;
    color: #17a2b8;
    margin-bottom: 20px;
    font-size: 1.8em;
}

/* Ingredients Section */
#ingredients-container {
    margin-bottom: 20px;
}

.ingredient-entry {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.ingredient-entry label {
    font-size: 1.1em;
    margin-right: 10px;
    width: 120px;
    text-align: right;
}

.ingredient-entry select,
.ingredient-entry input {
    padding: 8px;
    font-size: 1em;
    width: 100%;
    max-width: 300px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.ingredient-entry select:focus,
.ingredient-entry input:focus {
    border-color: #17a2b8;
    outline: none;
}

button {
    padding: 10px 20px;
    background-color: #17a2b8;
    color: white;
    font-weight: bold;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

button:hover {
    background-color: #138496;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

/* Button styling for "Add Another Ingredient" */
button[type="button"] {
    background-color: #28a745;
    margin-right: 10px;
}

button[type="submit"] {
    background-color: #17a2b8;
}

/* Responsive Design for smaller screens */
@media screen and (max-width: 768px) {
    form {
        padding: 15px;
    }

    .ingredient-entry {
        flex-direction: column;
        align-items: flex-start;
    }

    .ingredient-entry label {
        width: 100%;
        margin-bottom: 5px;
        text-align: left;
    }

    .ingredient-entry select,
    .ingredient-entry input {
        max-width: 100%;
    }

    button {
        width: 100%;
        padding: 12px 0;
    }
}
</style>
</head>
<body>
    <h2>Add Ingredients to Recipe</h2>
    <form action="../../Controller/add_ingredients_to_recipe.php" method="POST">
        <input type="hidden" name="recette_id" value="<?php echo htmlspecialchars($recette_id); ?>">

        <div id="ingredients-container">
            <div class="ingredient-entry">
                <label for="ingredient">Ingredient:</label>
                <select name="ingredients[]" required>
                    <option value="" disabled selected>Select an ingredient</option>
                    <?php foreach ($ingredients as $ingredient): ?>
                        <option value="<?php echo $ingredient['ID_ingredient']; ?>">
                            <?php echo htmlspecialchars($ingredient['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" step="0.01" name="quantities[]" required>
            </div>
        </div>

        <button type="button" onclick="addIngredientEntry()">Add Another Ingredient</button>
        <button type="submit">Submit</button>
    </form>

    <script>
        function addIngredientEntry() {
            const container = document.getElementById('ingredients-container');
            const newEntry = document.createElement('div');
            newEntry.className = 'ingredient-entry';

            newEntry.innerHTML = `
                <label for="ingredient">Ingredient:</label>
                <select name="ingredients[]" required>
                    <?php foreach ($ingredients as $ingredient): ?>
                        <option value="<?php echo $ingredient['ID_ingredient']; ?>">
                            <?php echo htmlspecialchars($ingredient['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" step="0.01" name="quantities[]" required>
            `;
            container.appendChild(newEntry);
        }
    </script>
</body>
</html>

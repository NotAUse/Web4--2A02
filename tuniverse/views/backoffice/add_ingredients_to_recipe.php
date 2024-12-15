<?php
require_once "../../controllers/connexion.php";

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
    line-height: 2.6;
}

/* Center the form and give it some padding */
form {
    max-width: 800px;
    margin: 40px auto;
    padding: 40px;
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
    <form action="../../Controllers/add_ingredients_to_recipe.php" method="POST">
        <input type="hidden" name="recette_id" value="<?php echo htmlspecialchars($recette_id); ?>">

        <div id="ingredients-container">
            <div class="ingredient-entry">
                <label for="ingredient">Ingredient:</label>
                <select name="ingredients[]">
                    <option value="" disabled selected>Select an ingredient</option>
                    <?php foreach ($ingredients as $ingredient): ?>
                        <option value="<?php echo $ingredient['ID_ingredient']; ?>">
                            <?php echo htmlspecialchars($ingredient['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Please select an ingredient.</div>

                <label for="quantity">Quantity:</label>
                <input type="number" step="0.01" name="quantities[]">
                <div class="invalid-feedback">Please enter a valid quantity (positive number).</div>
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
                <select name="ingredients[]">
                    <?php foreach ($ingredients as $ingredient): ?>
                        <option value="<?php echo $ingredient['ID_ingredient']; ?>">
                            <?php echo htmlspecialchars($ingredient['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantity">Quantity:</label>
                <input type="number" step="0.01" name="quantities[]">
            `;
            container.appendChild(newEntry);
        }
        function validateForm() {
            const ingredientEntries = document.querySelectorAll('.ingredient-entry');
            let isValid = true;

            ingredientEntries.forEach(entry => {
                const ingredientSelect = entry.querySelector('select[name="ingredients[]"]');
                const quantityInput = entry.querySelector('input[name="quantities[]"]');
                let validIngredient = true;
                let validQuantity = true;

                // Validate ingredient selection
                if (ingredientSelect.value === "") {
                    validIngredient = false;
                    ingredientSelect.classList.add("is-invalid");
                    entry.querySelector('.invalid-feedback').style.display = "block";
                } else {
                    ingredientSelect.classList.remove("is-invalid");
                    entry.querySelector('.invalid-feedback').style.display = "none";
                }

                // Validate quantity (positive number)
                if (isNaN(quantityInput.value) || parseFloat(quantityInput.value) <= 0) {
                    validQuantity = false;
                    quantityInput.classList.add("is-invalid");
                    entry.querySelectorAll('.invalid-feedback')[1].style.display = "block";
                } else {
                    quantityInput.classList.remove("is-invalid");
                    entry.querySelectorAll('.invalid-feedback')[1].style.display = "none";
                }

                // If any field is invalid, set form validity to false
                if (!validIngredient || !validQuantity) {
                    isValid = false;
                }
            });

            // Show global error message if the form is not valid
            if (!isValid) {
                alert("Please fill in all fields correctly.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission if valid
        }
    </script>
</body>
</html>

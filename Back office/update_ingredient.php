<?php
require_once "../../Controller/connexion.php"; // Include the database connection

// Check if the id_ingredient is provided in the URL
if (isset($_GET['id_ingredient'])) {
    $id_ingredient = $_GET['id_ingredient'];

    try {
        // Fetch the ingredient details based on the ID
        $sql = "SELECT * FROM ingredient WHERE ID_ingredient = :id_ingredient";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the ingredient exists
        if ($stmt->rowCount() > 0) {
            $ingredient = $stmt->fetch(PDO::FETCH_ASSOC);
            $nom = $ingredient['nom'];
            $categorie = $ingredient['Categorie'];
            $unite = $ingredient['unite'];
        } else {
            echo '<p>Ingredient not found.</p>';
            exit;
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit;
    }
} else {
    echo '<p>No ingredient ID provided.</p>';
    exit;
}
?>

<style>
    /* General Page Styles */
    body {
        font-family: Arial, sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
        background-image: url('https://wakeforestpediatrics.com/wp-content/uploads/2021/09/WFP_august-21-blog_weight-management.jpeg'); /* Path to your background image */
        background-size: cover;  /* Ensures the background image covers the whole page */
        background-position: center; /* Centers the background image */
        background-repeat: no-repeat; /* Prevents repeating the image */
        background-attachment: fixed; /* Keeps the background fixed when scrolling */
    }


/* Container */
.container {
    margin-top: 50px;
    margin-bottom: 50px;
    padding: 20px;
}

/* Card Styling */
.card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 20px;
}

/* Form Title */
.card-title {
    font-size: 24px;
    font-weight: 600;
    color: #007bff;
}

/* Form Controls */
.form-control {
    font-size: 16px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
    margin-bottom: 20px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Label Styling */
.form-label {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 10px;
    display: inline-block;
}

/* Button Styling */
.btn {
    font-size: 16px;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    width: 100%;
}

.btn:hover {
    background-color: #0056b3;
}

/* Centering the Form */
.centered-form {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Form Card Adjustments */
.form-card {
    width: 100%;
    max-width: 800px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-card {
        width: 100%;
        max-width: 100%;
    }
}

/* Input and Select Options */
select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding-right: 30px; /* space for the dropdown icon */
}

select.form-control option {
    font-size: 16px;
}

select.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Error Message Styles */
.error-message {
    color: #ff0000;
    font-size: 14px;
    margin-top: 10px;
}


</style>

<!-- HTML Form to Edit Ingredient -->
<div class="container centered-form" style="max-width: 60%; padding: 20px;">
    <div class="card form-card shadow">
        <div class="card-body">
            <h4 class="card-title mb-4 text-center">Edit Ingredient</h4>
            <form action="../../Controller/update_ingredient.php" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Category</label>
                    <select class="form-control" id="categorie" name="categorie">
                        <option value="Vegetables" <?php echo ($categorie == 'Vegetables') ? 'selected' : ''; ?>>Vegetables</option>
                        <option value="Fruits" <?php echo ($categorie == 'Fruits') ? 'selected' : ''; ?>>Fruits</option>
                        <option value="Proteins" <?php echo ($categorie == 'Proteins') ? 'selected' : ''; ?>>Proteins</option>
                        <option value="Dairy" <?php echo ($categorie == 'Dairy') ? 'selected' : ''; ?>>Dairy</option>
                        <option value="Grains" <?php echo ($categorie == 'Grains') ? 'selected' : ''; ?>>Grains</option>
                        <option value="Fats and Oils" <?php echo ($categorie == 'Fats and Oils') ? 'selected' : ''; ?>>Fats and Oils</option>
                        <option value="Sweets/Sugars" <?php echo ($categorie == 'Sweets/Sugars') ? 'selected' : ''; ?>>Sweets/Sugars</option>
                        <option value="Nuts and Seeds" <?php echo ($categorie == 'Nuts and Seeds') ? 'selected' : ''; ?>>Nuts and Seeds</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="unite" class="form-label">Unit</label>
                    <select class="form-control" id="unite" name="unite">
                        <option value="">Select Unit</option>
                        <!-- Volume Metrics -->
                        <option value="ml" <?php echo ($unite == 'ml') ? 'selected' : ''; ?>>Milliliter (ml)</option>
                        <option value="l" <?php echo ($unite == 'l') ? 'selected' : ''; ?>>Liter (l)</option>
                        <option value="cup" <?php echo ($unite == 'cup') ? 'selected' : ''; ?>>Cup</option>
                        <option value="tsp" <?php echo ($unite == 'tsp') ? 'selected' : ''; ?>>Teaspoon (tsp)</option>
                        <option value="tbsp" <?php echo ($unite == 'tbsp') ? 'selected' : ''; ?>>Tablespoon (tbsp)</option>
                        
                        <!-- Weight Metrics -->
                        <option value="g" <?php echo ($unite == 'g') ? 'selected' : ''; ?>>Gram (g)</option>
                        <option value="kg" <?php echo ($unite == 'kg') ? 'selected' : ''; ?>>Kilogram (kg)</option>
                        <option value="mg" <?php echo ($unite == 'mg') ? 'selected' : ''; ?>>Milligram (mg)</option>
                        <option value="oz" <?php echo ($unite == 'oz') ? 'selected' : ''; ?>>Ounce (oz)</option>
                        <option value="lb" <?php echo ($unite == 'lb') ? 'selected' : ''; ?>>Pound (lb)</option>
                    </select>
                </div>
                <input type="hidden" name="id_ingredient" value="<?php echo $id_ingredient; ?>">
                <button type="submit" class="btn btn-primary">Update Ingredient</button>
            </form>
        </div>
    </div>
</div>

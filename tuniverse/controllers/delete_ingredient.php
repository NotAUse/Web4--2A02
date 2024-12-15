<?php
// delete_ingredient.php
require_once "../Controllers/connexion.php"; // Database connection
require_once "../Models/Ingredient.php"; // Ingredient model

// Retrieve the ID of the ingredient from the POST request
$id_ingredient = $_POST['id_ingredient'] ?? null;

// Check if the ID is valid
if (!$id_ingredient || !is_numeric($id_ingredient)) {
    echo "<script>alert('Invalid ingredient ID'); window.history.back();</script>";
    exit;
}

try {
    // Create an Ingredient object with both the ID and database connection
    $ingredient = new Ingredient($id_ingredient, $conn);

    // Call the delete method to remove the ingredient
    $ingredient->delete();

    // Redirect or display success message
    echo "<script>alert('Ingredient deleted successfully'); window.location.href='../Views/Backoffice/Ingredient.php';</script>";
} catch (Exception $e) {
    // Handle any errors
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>";
}


?>

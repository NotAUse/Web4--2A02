<?php
require_once "../Controllers/connexion.php";
require_once "../Models/Ingredient.php";

$ingredientModel = new Ingredient($conn);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_ingredient = $_POST['id_ingredient'];
        $nom = $_POST['nom'];
        $categorie = $_POST['categorie'];
        $unite = $_POST['unite'];

        if ($id_ingredient && $nom && $categorie && $unite) {
            if ($ingredientModel->updateIngredient($id_ingredient, $nom, $categorie, $unite)) {
                echo "<script>alert('Ingredient updated successfully!'); window.history.back();</script>";
            } else {
                throw new Exception('Failed to update ingredient.');
            }
        } else {
            throw new Exception('All fields are required.');
        }
    } else {
        throw new Exception('Invalid request method.');
    }
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>

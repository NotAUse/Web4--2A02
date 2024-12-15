<?php
require_once "../Controllers/connexion.php";
require_once "../Controllers/ingredientController.php";

$ingredientController = new IngredientController($conn);

$nom = $_POST['nom'] ?? '';
$unite = $_POST['unite'] ?? '';
$categorie = $_POST['categorie'] ?? '';

if (empty($nom) || empty($unite) || empty($categorie)) {
    echo "<script>alert('All fields are required!'); window.location.href='../Views/Backoffice/Ingredient.php';</script>";
    exit;
}

$message = $ingredientController->addIngredient($nom, $unite, $categorie);
echo "<script>alert('$message'); window.location.href='../Views/Backoffice/Ingredient.php';</script>";
?>

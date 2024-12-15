<?php
require_once "../Controllers/connexion.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recette_id = $_POST['recette_id'];
        $ingredients = $_POST['ingredients'];
        $quantities = $_POST['quantities'];

        $conn->beginTransaction();

        foreach ($ingredients as $key => $ingredient_id) {
            $quantity = $quantities[$key];

            $sql = "INSERT INTO recipe_ingredient (recette_id, ingredient_id, quantity) 
                    VALUES (:recette_id, :ingredient_id, :quantity)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':recette_id', $recette_id, PDO::PARAM_INT);
            $stmt->bindParam(':ingredient_id', $ingredient_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
            $stmt->execute();
        }

        $conn->commit();

        echo "<script>alert('Ingredients added successfully!'); window.location.href='../Views/Backoffice/recette_affich.php';</script>";
    } else {
        throw new Exception('Invalid request method.');
    }
} catch (Exception $e) {
    $conn->rollBack();
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>";
}
?>

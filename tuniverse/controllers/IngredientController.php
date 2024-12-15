<?php

require_once "../Models/Ingredient.php";

class IngredientController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addIngredient($nom, $unite, $categorie)
    {
        try {
            $sql = "INSERT INTO ingredient (nom, unite, categorie) VALUES (:nom, :unite, :categorie)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':unite', $unite);
            $stmt->bindParam(':categorie', $categorie);

            return $stmt->execute() ? "Ingredient added successfully!" : "Error: Could not add ingredient.";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deleteIngredient($id_ingredient)
    {
        try {
            $sql = "DELETE FROM ingredient WHERE ID_ingredient = :id_ingredient";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updateIngredient($id_ingredient, $nom, $unite, $categorie)
    {
        try {
            $sql = "UPDATE ingredient SET nom = :nom, unite = :unite, categorie = :categorie WHERE ID_ingredient = :id_ingredient";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':unite', $unite);
            $stmt->bindParam(':categorie', $categorie);

            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>

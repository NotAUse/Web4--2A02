<?php

// Ingredient.php model

class Ingredient {
    private $id_ingredient;
    private $nom;
    private $unite;
    private $categorie;
    private $conn;  // Database connection

    // Constructor accepts the id_ingredient and connection
    public function __construct($id_ingredient, $conn) {
        $this->id_ingredient = $id_ingredient;
        $this->conn = $conn;  // Store the database connection
    }

    // Delete method
    public function delete() {
        // Prepare the SQL delete statement
        $stmt = $this->conn->prepare("DELETE FROM ingredient WHERE ID_ingredient = :id");
        $stmt->bindParam(':id', $this->id_ingredient, PDO::PARAM_INT);

        // Execute the statement and check if rows were affected
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Error deleting ingredient");
        }
    }
}

?>

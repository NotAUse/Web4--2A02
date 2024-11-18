<?php
require_once "../Controller/connexion.php"; // Ensure this points to the correct location of your connexion.php file

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id_ingredient = $_POST['id_ingredient'];
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $unite = $_POST['unite'];

    // Validate the inputs (you can add more validation as needed)
    if (!empty($nom) && !empty($categorie) && !empty($unite)) {
        try {
            // Update the ingredient in the database
            $sql = "UPDATE ingredient SET nom = :nom, Categorie = :categorie, unite = :unite WHERE ID_ingredient = :id_ingredient";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
            $stmt->bindParam(':unite', $unite, PDO::PARAM_STR);

            // Execute the query
            if ($stmt->execute()) {
                echo '<p>Ingredient updated successfully!</p>';
            } else {
                echo '<p>Error: Unable to update ingredient.</p>';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo '<p>Error: Please fill in all fields.</p>';
    }
} else {
    echo '<p>No form submission detected.</p>';
}
?>

<?php
require_once "../Controller/connexion.php"; // Ensure the correct path

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_ingredient'])) {
        $id_ingredient = $_POST['id_ingredient'];

        try {
            // Prepare the delete statement
            $sql = "DELETE FROM ingredient WHERE ID_ingredient = :id_ingredient";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_ingredient', $id_ingredient, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect to the ingredient list page after successful deletion
                header("Location: ../View\Back office\Ingredient affich.php");
                exit();
            } else {
                echo '<p>Error: Unable to delete ingredient.</p>';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();//utile pour le débogage
        }
    } else {
        echo '<p>No ingredient ID provided.</p>';
    }
}
?>

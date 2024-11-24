<?php

require_once "../Controller/connexion.php"; // Ensure this points to the correct location of your connexion.php file

try {
    // Recupere form data post
    $nom = $_POST['nom'] ?? '';
    $unite = $_POST['unite'] ?? '';
    $categorie = $_POST['categorie'] ?? '';

    // Validate form data
    if (empty($nom) || empty($unite) || empty($categorie)) {
        echo "<script>alert('All fields are required!'); window.location.href='../View/Back office/Ingredient.php';</script>";
        exit;
    }

    // Check if the ingredient already exists
    $sql_check = "SELECT COUNT(*) FROM ingredient WHERE nom = :nom";
    $stmt_check = $conn->prepare($sql_check); 
    $stmt_check->bindParam(':nom', $nom);//liaison
    $stmt_check->execute();
    $exists = $stmt_check->fetchColumn();

    if ($exists > 0) {
        // Ingredient already exists
        echo "<script>alert('Ingredient already exists!'); window.location.href='../View/Back office/Ingredient.php';</script>";
    } else {
        // Insert the new ingredient with the category
        $sql_insert = "INSERT INTO ingredient (nom, unite, categorie) VALUES (:nom, :unite, :categorie)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindParam(':nom', $nom);
        $stmt_insert->bindParam(':unite', $unite);
        $stmt_insert->bindParam(':categorie', $categorie);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Ingredient added successfully!'); window.location.href='../View/Back office/Ingredient.php';</script>";
        } else {
            echo "Error: Could not add ingredient.";
        }
    }
} catch (PDOException $e) {
    // Handle any PDO errors
    echo "Error: " . $e->getMessage();
}
?>

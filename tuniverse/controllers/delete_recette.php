<?php
require_once "../controllers/connexion.php";
require_once "../models/Recette.php";



try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_recette'])) {
        $id_recette = $_POST['id_recette'];

        $recetteModel = new Recette($id_recette);

        if ($recetteModel->deleterecette($id_recette)) {
            echo "<script>alert('Recipe deleted successfully!'); window.location.href='../views/backoffice/recette_affich.php';</script>";
        } else {
            throw new Exception('Failed to delete the recipe.');
        }
    } else {
        throw new Exception('Invalid request.');
    }
} catch (Exception $e) {
    echo "<script>alert('" . $e->getMessage() . "'); window.location.href='../views/backoffice/recette_affich.php';</script>";
}


?>

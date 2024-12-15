<?php
require_once "../Controllers/connexion.php"; // Database connection
require_once "../Models/Recette.php"; // Import the model

$recetteModel = new Recette();  // Instantiate Recette without passing $conn

try {
    // Retrieve form data
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $categorie = $_POST['categorie'] ?? '';
    $audioFile = $_FILES['audio'] ?? null;
    $imageFile = $_FILES['image'] ?? null; // Handle image file input



    if ($imageFile && $imageFile['error'] === 0) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
        if (in_array($imageFile['type'], $allowedImageTypes)) {
            $imageFileName = uniqid('image_', true) . '.' . pathinfo($imageFile['name'], PATHINFO_EXTENSION);
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . 'frontoffice/';
            $targetFile = $targetDir . $imageFileName;
    
            // Créez le dossier cible s'il n'existe pas
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
    
            // Déplacez le fichier téléchargé vers le répertoire cible
            if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
                $imagePath = 'frontoffice' . $imageFileName; // Stockez le chemin du fichier
            } else {
                throw new Exception('Échec du téléchargement de l\'image.');
            }
        } else {
            throw new Exception('Type de fichier d\'image non valide.');
        }
    } else {
        throw new Exception('Aucun fichier image téléchargé ou une erreur est survenue.');
    }




    // Add the recipe and get the success message
    $message = $recetteModel->addRecette($nom, $description, $categorie, $audioFile,$imageFile);

    // Escape single quotes in the message to prevent JavaScript errors
    $escapedMessage = addslashes($message);

    // Show success message and redirect
    echo "<script>alert('$escapedMessage'); window.location.href='../Views/Backoffice/add_Recette.php';</script>";
} catch (Exception $e) {
    // Escape single quotes in the error message to prevent JavaScript errors
    $escapedErrorMessage = addslashes($e->getMessage());

    // Show error message
    echo "<script>alert('Error: $escapedErrorMessage'); window.history.back();</script>";
}
?>

<?php
require_once "../Controllers/connexion.php";
//require_once "../Models/Recette.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_recette = $_POST['id_recette'] ?? null;
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $categorie = $_POST['categorie'] ?? '';
        $audio = null; // Initialisez la variable
        $image = null; // Initialisez la variable pour l'image

        // Vérifiez si un fichier audio a été téléchargé
        if (isset($_FILES['audio']) && $_FILES['audio']['error'] === 0) {
            $audioFile = $_FILES['audio']; // Récupérer le fichier audio
            $allowedTypes = ['audio/mp3', 'audio/wav', 'audio/mpeg', 'audio/ogg']; // Définir les types autorisés

            // Vérifiez si le type de fichier est valide
            if (in_array($audioFile['type'], $allowedTypes)) {
                $audioFileName = uniqid('audio_', true) . '.' . pathinfo($audioFile['name'], PATHINFO_EXTENSION);
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . 'frontoffice/';
                $targetFile = $targetDir . $audioFileName;

                // Créez le dossier cible s'il n'existe pas
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Déplacez le fichier téléchargé vers le répertoire cible
                if (move_uploaded_file($audioFile['tmp_name'], $targetFile)) {
                    $audio = 'frontoffice/' . $audioFileName; // Stockez le chemin du fichier
                } else {
                    throw new Exception('Échec du téléchargement du fichier audio.');
                }
            } else {
                throw new Exception('Type de fichier audio non valide.');
            }



         


        }




        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $imageFile = $_FILES['image']; // Récupérer le fichier image
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif']; // Types d'images autorisés

            // Vérifiez si le type de fichier image est valide
            if (in_array($imageFile['type'], $allowedImageTypes)) {
                $imageFileName = uniqid('image_', true) . '.' . pathinfo($imageFile['name'], PATHINFO_EXTENSION);
                $targetImageDir = $_SERVER['DOCUMENT_ROOT'] . 'frontoffice/';
                $targetImageFile = $targetImageDir . $imageFileName;

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
        

                if (move_uploaded_file($imageFile['tmp_name'], $targetImageFile)) {
                    $image = 'frontoffice/' . $imageFileName; // Stockez le chemin de l'image
                } else {
                    throw new Exception('Échec du téléchargement de l\'image.');
                }
            } else {
                throw new Exception('Type de fichier image non valide.');
            }
        }

       
        // Vérifiez si l'ID de la recette est fourni
        if (!$id_recette) {
            throw new Exception('ID de recette manquant.');
        }


    




        // Requête SQL pour mettre à jour la recette
        $sql = "UPDATE recette SET Nom = :nom, description = :description, categorie = :categorie, audio = :audio , image = :image WHERE id_recette = :id_recette";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->bindParam(':audio', $audio, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>alert('Recette mise à jour avec succès !'); window.location.href='../Views/Backoffice/recette_affich.php';</script>";
        } else {
            throw new Exception('Échec de la mise à jour de la recette.');
        }
    } else {
        throw new Exception('Méthode de requête invalide.');
    }
} catch (Exception $e) {
    echo "<script>alert('Erreur : " . $e->getMessage() . "'); window.history.back();</script>";
}
?>

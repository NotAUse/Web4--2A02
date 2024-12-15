<?php
require_once('../../config/selima.php'); // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si l'ID est présent dans le formulaire
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        // Préparer la requête de suppression
        $sql = "DELETE FROM categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers la page de liste des catégories après la suppression
            header('Location: list_categorie.php'); // Rediriger vers la page de liste des catégories
            exit;
        } else {
            echo "Une erreur est survenue lors de la suppression.";
        }
    } else {
        echo "ID invalide.";
    }
}
?>


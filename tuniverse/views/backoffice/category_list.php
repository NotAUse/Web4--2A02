<?php
// Charger la configuration
require_once('../../config/selima.php');

// Charger le modèle des catégories
include '../../models/CategoryModel.php';

// Instancier le modèle
$categoryModel = new CategoryModel();

// Récupérer les données des catégories
$categories = $categoryModel->getAllCategories();

// Gérer la suppression d'une catégorie
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $categoryModel->deleteCategory($_GET['id']);
    // Rediriger pour éviter la resoumission du formulaire en actualisant la page
    header('Location: category_list.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories</title>
</head>
<body>
    <h1>Liste des catégories</h1>

    <!-- Afficher le tableau des catégories -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Langue</th>
                <th>Popularité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['id']); ?></td>
                        <td><?php echo htmlspecialchars($category['nom']); ?></td>
                        <td><?php echo htmlspecialchars($category['description']); ?></td>
                        <td><?php echo htmlspecialchars($category['langue']); ?></td>
                        <td><?php echo htmlspecialchars($category['popularite']); ?></td>
                        <td>
                            <a href="update_category.php?id=<?php echo $category['id']; ?>">Modifier</a>
                            <a href="category_list.php?action=delete&id=<?php echo $category['id']; ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Aucune catégorie disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

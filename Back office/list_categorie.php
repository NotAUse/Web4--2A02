<?php
// Connexion à la base de données
require_once('../../config.php');

// Initialisation des variables
$errorMessage = null;

// Traitement du formulaire d'ajout de catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $langue = isset($_POST['langue']) ? trim($_POST['langue']) : '';
    $popularite = isset($_POST['popularite']) ? trim($_POST['popularite']) : '';

    // Validation des champs
    if (strlen($nom) < 3) {
        $errorMessage = 'Le nom doit comporter au moins 3 caractères.';
    } elseif (!preg_match('/^[A-Za-z0-9\s]+$/', $description)) {
        $errorMessage = 'La description ne doit pas contenir de caractères spéciaux.';
    } elseif (empty($langue)) {
        $errorMessage = 'La langue est obligatoire.';
    } elseif (!ctype_digit($popularite) || $popularite < 1 || $popularite > 100) {
        $errorMessage = 'La popularité doit être un nombre entre 1 et 100.';
    }

    // Si la validation est réussie, on insère la catégorie
    if (!$errorMessage) {
        $sql = "INSERT INTO categorie (nom, description, langue, popularite, date_ajout) 
                VALUES (:nom, :description, :langue, :popularite, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':langue' => $langue,
            ':popularite' => $popularite
        ]);

        // Redirection pour éviter un double envoi du formulaire
        header('Location: list_categorie.php');
        exit;
    }
}

// Récupérer toutes les catégories existantes
$sql = "SELECT id, nom, description, langue, popularite, date_ajout FROM categorie";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des catégories</title>
    <script>
        // Validation JavaScript pour le formulaire
        function validateForm(event) {
            event.preventDefault(); // Empêche l'envoi du formulaire avant validation

            let nom = document.getElementById('nom').value.trim();
            let description = document.getElementById('description').value.trim();
            let langue = document.getElementById('langue').value.trim();
            let popularite = document.getElementById('popularite').value.trim();

            // Validation des champs
            if (nom.length < 3) {
                alert('Le nom doit comporter au moins 3 caractères.');
                return false;
            }

            if (!/^[A-Za-z0-9\s]+$/.test(description)) {
                alert('La description ne doit pas contenir de caractères spéciaux.');
                return false;
            }

            if (langue === "") {
                alert('La langue est obligatoire.');
                return false;
            }

            if (!/^\d+$/.test(popularite) || popularite < 1 || popularite > 100) {
                alert('La popularité doit être un nombre entre 1 et 100.');
                return false;
            }

            // Si tout est valide, soumettre le formulaire
            document.getElementById('add-category-form').submit();
        }
    </script>
</head>
<body>
    <h1>Liste des catégories</h1>

    <!-- Affichage des messages d'erreur -->
    <?php if ($errorMessage): ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>

    <!-- Tableau d'affichage des catégories -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Langue</th>
                <th>Popularité</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $categorie): ?>
                <tr>
                    <td><?php echo htmlspecialchars($categorie['id']); ?></td>
                    <td><?php echo htmlspecialchars($categorie['nom']); ?></td>
                    <td><?php echo htmlspecialchars($categorie['description']); ?></td>
                    <td><?php echo htmlspecialchars($categorie['langue']); ?></td>
                    <td><?php echo htmlspecialchars($categorie['popularite']); ?></td>
                    <td><?php echo htmlspecialchars($categorie['date_ajout']); ?></td>
                    <td>
                        <!-- Formulaire pour supprimer une catégorie -->
                        <form method="POST" action="delete.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                        <!-- Lien vers la page de mise à jour -->
                        <a href="update.php?id=<?php echo $categorie['id']; ?>">Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!-- Formulaire d'ajout de catégorie -->
            <tr>
                <form id="add-category-form" method="POST" action="list_categorie.php" novalidate onsubmit="validateForm(event)">
                    <td>Auto</td>
                    <td><input type="text" id="nom" name="nom"></td>
                    <td><input type="text" id="description" name="description"></td>
                    <td><input type="text" id="langue" name="langue"></td>
                    <td><input type="text" id="popularite" name="popularite"></td>
                    <td>Auto</td>
                    <td>
                        <button type="submit">Ajouter</button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</body>
</html>

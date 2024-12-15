<?php
// Inclure la connexion à la base de données
require_once('../../config/selima.php');

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier que l'ID est un entier valide
    if (filter_var($id, FILTER_VALIDATE_INT)) {

        // Récupérer la catégorie avec l'ID correspondant
        $stmt = $pdo->prepare("SELECT * FROM categorie WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifier si la catégorie existe
        $categorie = $stmt->fetch();

        // Si la catégorie n'existe pas, afficher un message
        if (!$categorie) {
            echo "<p>Catégorie non trouvée.</p>";
            exit;
        }

        // Traitement de la soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom']);
            $description = trim($_POST['description']);
            $langue = trim($_POST['langue']);
            $popularite = trim($_POST['popularite']);

            // Validation simple
            if (empty($nom) || empty($description) || empty($langue) || empty($popularite)) {
                $errorMessage = "Tous les champs sont obligatoires.";
            } else {
                // Mettre à jour la catégorie dans la base de données
                $updateStmt = $pdo->prepare("UPDATE categorie SET nom = :nom, description = :description, langue = :langue, popularite = :popularite WHERE id = :id");
                $updateStmt->execute([
                    ':nom' => $nom,
                    ':description' => $description,
                    ':langue' => $langue,
                    ':popularite' => $popularite,
                    ':id' => $id
                ]);

                // Redirection vers la liste des catégories après mise à jour
                header('Location: list_categorie.php');
                exit;
            }
        }

    } else {
        echo "<p>ID invalide.</p>";
        exit;
    }
} else {
    echo "<p>ID de la catégorie manquant.</p>";
    exit;
}
?>

<!-- Formulaire de modification de la catégorie -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la catégorie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h1 {
            color: #5A5A5A;
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier la catégorie</h1>

        <!-- Afficher l'erreur, s'il y en a -->
        <?php if (isset($errorMessage)): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($categorie['id'] ?? ''); ?>">

            <div class="form-group">
                <label for="nom">Nom de la catégorie :</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($categorie['nom'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($categorie['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="langue">Langue :</label>
                <textarea id="langue" name="langue" required><?php echo htmlspecialchars($categorie['langue'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="popularite">Popularité :</label>
                <textarea id="popularite" name="popularite" required><?php echo htmlspecialchars($categorie['popularite'] ?? ''); ?></textarea>
            </div>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>

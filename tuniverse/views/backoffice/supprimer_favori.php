<?php
session_start(); // Démarre la session

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tuniverse', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si l'ID du favori est passé
if (isset($_GET['id_favori'])) {
    $id_favori = (int)$_GET['id_favori']; // Assurez-vous que l'ID est un entier

    // Supprimer l'histoire des favoris
    $stmt = $pdo->prepare("DELETE FROM favoris WHERE id_favori = :id_favori");
    $stmt->bindParam(':id_favori', $id_favori, PDO::PARAM_INT);
    $stmt->execute();

    // Message de confirmation
    $message = "L'histoire a été supprimée de vos favoris.";
} else {
    $message = "Aucun favori sélectionné pour suppression.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression réussie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Message de confirmation */
        .message {
            background-color: #ff9800; /* Orange clair */
            color: white;
            padding: 15px;
            margin: 20px auto;
            width: 60%;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <!-- Message de confirmation -->
    <?php if (isset($message)): ?>
        <div class="message">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 20px;">
        <a href="list_favoris.php" class="btn">Retour à la liste des favoris</a>
    </div>

</body>
</html>

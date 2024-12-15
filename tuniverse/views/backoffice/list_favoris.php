<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tuniverse', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les favoris
$sql = "SELECT f.id_favori, f.session_id, h.titre 
        FROM favoris f
        JOIN histoires h ON f.id_histoire = h.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Favoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        /* Header styles */
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }

        /* Table styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
        }
        
        th {
            background-color: #3498db;
            color: white;
        }

        td {
            background-color: #f4f6f9;
        }

        tr:hover td {
            background-color: #e1e7f0;
        }

        /* No favorites message */
        p {
            text-align: center;
            font-size: 18px;
            color: #7f8c8d;
        }

        /* Button styles */
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

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h1>Liste des Favoris</h1>

    <?php if (empty($favoris)): ?>
        <p>Aucun favori ajouté pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID de Session</th>
                    <th>Histoire Favorite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($favoris as $favori): ?>
                    <tr>
                        <td><?= htmlspecialchars($favori['session_id']) ?></td>
                        <td><?= htmlspecialchars($favori['titre']) ?></td>
                        <td>
                            <!-- Lien vers supprimer_favori.php avec l'ID du favori -->
                            <a href="supprimer_favori.php?id_favori=<?= $favori['id_favori'] ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette histoire de vos favoris ?');">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="list_histoire.php" class="btn">Retour à l'accueil</a>
    </div>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si l'ID est passé dans l'URL
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "ID manquant dans la requête."]);
        exit;
    }

    $id = (int)$_GET['id']; // Sécuriser l'entrée
    $story_url = "http://localhost/views/backoffice/histoire.php?id=" . $id; // URL de l'histoire

    try {
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=tuniverse;charset=utf8mb4';
        $username = 'root'; // Remplacez par votre nom d'utilisateur
        $password = ''; // Remplacez par votre mot de passe

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // Requête pour incrémenter les vues
        $query = "UPDATE histoires SET vues = vues + 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            // Si l'incrémentation réussit, afficher la page de confirmation
            $message = "Une vue est ajoutée à cette histoire.";
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "Histoire introuvable."]);
            exit;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Erreur : " . $e->getMessage()]);
        exit;
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Vue</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .message {
            font-size: 18px;
            margin-bottom: 20px;
            color: green;
        }

        .button {
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Confirmation d'Incrémentation de Vue</div>
        
        <?php if (isset($message)): ?>
            <div class="message"><?= $message ?></div>
            <a href="<?= $story_url ?>" class="button">Se diriger vers l'histoire</a>
        <?php else: ?>
            <div class="error">Une erreur est survenue. Veuillez réessayer.</div>
        <?php endif; ?>
    </div>
</body>
</html>

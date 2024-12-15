<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Vérifier si l'ID est passé en paramètre
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo "ID manquant dans la requête.";
        exit;
    }

    $id = (int)$_GET['id']; // Sécurisation de l'ID

    try {
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=categorie_db;charset=utf8mb4';
        $username = 'root'; // Remplace par ton utilisateur
        $password = ''; // Remplace par ton mot de passe

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // Incrémenter les vues pour l'ID spécifié
        $updateQuery = "UPDATE histoires SET vues = vues + 1 WHERE id = :id";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStmt->execute();

        // Redirection basée sur l'ID
        if ($id === 1) {
            header('Location: /site/views/Front%20Web/7_sbeya.html');
        } elseif ($id === 2) {
            header('location: /site/views/front%20web/sabat_laarousa.html');
        } elseif ($id === 4) {
            header('Location: /site/views/Front%20Web/louiza.html');
        } elseif ($id === 5) {
            header('Location:/site/views/Front%20Web/sidi_teta.html');
        } elseif ($id === 6) {
            header('Location: /site/views/Front%20Web/tanit.html');
        } elseif ($id === 3) {
            header('Location: /site/views/Front%20Web/mieux_prevenir.html');
            

        } else {
            http_response_code(404);
            echo "Histoire introuvable.";
        }

        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erreur : " . $e->getMessage();
        exit;
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée.";
    exit;
}


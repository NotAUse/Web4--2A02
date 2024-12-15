<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Récupérer l'ID de l'histoire depuis les paramètres URL
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "ID manquant dans la requête."]);
        exit;
    }

    $id = (int)$_GET['id']; // Sécuriser l'entrée

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
            echo json_encode(["status" => "success", "message" => "Vues mises à jour."]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "Histoire introuvable."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Erreur : " . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
}
?>

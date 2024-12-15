<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=categorie_db;charset=utf8';
$username = 'root';
$password = '';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); // Nous renvoyons du JSON

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération de l'ID passé en paramètre
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Requête pour obtenir l'URL de l'image dans la base de données
$query = $pdo->prepare("SELECT images FROM histoires WHERE id = ?");
$query->execute([$id]);
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Retourne l'URL de l'image en format JSON
    echo json_encode(['images' => 'http://localhost/site/' . $result['images']]);
} else {
    echo json_encode(['images' => 'Image non trouvée']);
}
?>

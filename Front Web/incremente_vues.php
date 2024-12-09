<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "username", "password", "database_name");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer le nom de l'histoire depuis l'URL
$nom_histoire = isset($_GET['nom']) ? $_GET['nom'] : '';

// Incrémenter le nombre de vues dans la base de données
$sql = "UPDATE recits SET vues = vues + 1 WHERE nom = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nom_histoire);

if ($stmt->execute()) {
    // Rediriger vers la page HTML de l'histoire après incrémentation
    header("Location: " . strtolower(str_replace(" ", "_", $nom_histoire)) . ".html");
    exit;
} else {
    echo "Erreur : " . $conn->error;
}

$stmt->close();
$conn->close();
?>

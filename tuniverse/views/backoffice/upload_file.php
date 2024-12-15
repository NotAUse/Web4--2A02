<?php
// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=tuniverse;charset=utf8mb4';
$username = 'root'; // Remplacez par votre nom d'utilisateur
$password = ''; // Remplacez par votre mot de passe

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Requête pour récupérer toutes les histoires
    $query = "SELECT * FROM histoires";
    $stmt = $pdo->query($query);

    // Affichage des histoires
    while ($histoire = $stmt->fetch()) {
        echo "<div class='histoire'>";
        echo "<h2>" . htmlspecialchars($histoire['titre']) . "</h2>";
        echo "<p>" . htmlspecialchars($histoire['description']) . "</p>";

        // Affichage du lien du fichier si disponible
        if (!empty($histoire['file_link'])) {
            echo "<a href='" . htmlspecialchars($histoire['file_link']) . "' target='_blank'>Lire l'histoire (fichier)</a>";
        }

        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
